// Global variables
var pathname = window.location.pathname;
var project = pathname.substr(11);

/* fbAsyncInit
 *
 * Set variables to connect the page with our facebook-app
 *
 */
window.fbAsyncInit = function() {
    FB.init({
        appId      : '188876558188407',
        xfbml      : true,
        version    : 'v2.8'
    });
    loginCheck();
    initStoryWorld();
}

function loginCheck(){
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            return true;
        }
        else {
            login_fb();
            return false;
        }
    });
}

function login_fb() {
    FB.login(function(response){
        if (response.authResponse) {
        }
        else{
            window.location.replace("/story-list");
        }
    }, {
        scope: 'manage_pages',
        return_scopes: true
    });
}


/* StoryWorld Building
 *
 * D3.js
 *
 */

// build storywold layout
var svg = d3.select("#svg"),
    width = +svg.attr("width"),
    height = +svg.attr("height");

// setup forces before rendering nodes and lines
var simulation = d3.forceSimulation()
    .force("link", d3.forceLink().id(function(d) { return d.id; }))
    .force("charge", d3.forceManyBody())
    .force("center", d3.forceCenter(width / 2, height / 2));


function initStoryWorld() {
    d3.json(pathname+'/get-page', function(graph) {
      var story = JSON.parse(graph.story);

      if (!story) {
          spawnNewStory(graph);
      }
      else{
          loadStory(graph);
      }
  });
}

function spawnNewStory(data) {
  var storyBuilder = [];
  var storyJSON = {nodes: storyBuilder, links: []};

  FB.api( '/me/posts', { access_token: data.token, fields:'id, picture'}, function(response) {
    response.data.forEach(function(entry){
      if (entry.picture) {
        storyBuilder.push({id: entry.id, name: 'facebook', url:'https://facebook.com/'+ entry.id, image: entry.picture});
      } else {
        storyBuilder.push({id: entry.id, name: 'facebook', url:'https://facebook.com/'+ entry.id, image: 'https://via.placeholder.com/350x250'});
      }
    });

    storyJSON = JSON.stringify(storyJSON);

    // sends the JSON to the database
    $.ajax({
      type: "POST",
      url: pathname+'/save-story',
      data: {storyJSON, '_token': $('input[name=_token]').val(), project},
      dataType: 'json'
    });
    initStoryWorld();
  });
}

// load Jeson an build links and nodes
function loadStory(graph) {

  var dataset = JSON.parse(graph.story);

  // Setup link to source and target
  var link = svg.append("g")
      .attr("class", "links")
      .selectAll("line")
      .data(dataset.links)
      .enter().append("line")
        .attr("stroke-width", function(d) { return Math.sqrt(8); });

  // Setup node
  var node = svg.selectAll(".node")
      .data(dataset.nodes)
      .enter().append("g")
        .attr("class", "node")
        .attr("id", function(d) { return d.id })
        .call(d3.drag()
            .on("start", dragstarted)
            .on("drag", dragged)
            .on("end", dragended));

  node.append("image")
      .attr("xlink:href", function(d) { return d.image })
      .attr("x", -25)
      .attr("y", -25)
      .attr("width", 50)
      .attr("height", 50);


  node.append("svg:a")
  .attr("xlink:href", function(d){return d.url;})
  .attr("target", "_blank")
  .attr("x", -25)
  .attr("y", -25)
  .attr("width", 50)
  .attr("height", 50)
  .append("text")
    .attr("x", 28)
    .attr("y", 5)
    .text(function(d) { return d.name });

  simulation
      .nodes(dataset.nodes)
      .on("tick", ticked);

  simulation
      .force("link")
      .links(dataset.links)
      .distance(120);


  function ticked() {
    link
        .attr("x1", function(d) { return d.source.x; })
        .attr("y1", function(d) { return d.source.y; })
        .attr("x2", function(d) { return d.target.x; })
        .attr("y2", function(d) { return d.target.y; });

    node.attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });
  }
}

function dragstarted(d) {
  if (!d3.event.active) simulation.alphaTarget(0.3).restart();
  d.fx = d.x;
  d.fy = d.y;
}

function dragged(d) {
  d.fx = d3.event.x;
  d.fy = d3.event.y;
}

function dragended(d) {
  if (!d3.event.active) simulation.alphaTarget(0);
  d.fx = null;
  d.fy = null;
}

// Link Building
document.getElementById("js-new-link").onclick = function() {buildLink()};

function buildLink() {
  d3.json(pathname+'/get-page', function(graph) {
    var story = JSON.parse(graph.story);
    if (story.links.length == 0) {
      var linkBuilder = [];
    }else{
      var linkBuilder = story.links;
    };

    var storyJSON = {nodes: story.nodes, links: linkBuilder};
    var Source = prompt("Please enter the source", '');
    var Target = prompt("Please enter the target", '');

    if (Source == null || Source == '' && Target == null || Target == '') {
      console.log("User cancelled the prompt.");
    } else {

        linkBuilder.push({source: Source, target: Target});
        storyJSON = JSON.stringify(storyJSON);

        // sends the JSON to the database
        $.ajax({
          type: "POST",
          url: pathname+'/save-story',
          data: {storyJSON, '_token': $('input[name=_token]').val(), project},
          dataType: 'json'
        });

        document.reload();
    }
  });
}
