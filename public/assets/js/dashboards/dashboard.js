window.onload = function() {

  var trigger = new Trigger();
  trigger.findTrigger();

  window.onscroll = function() {
    fixedHeader()
  };
};



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
var svg = d3.select("#js-storyworld"),
    width = +svg.attr("width"),
    height = +svg.attr("height");

svg.select("rect")
    .attr("x", -2000)
    .attr("y", -2000)
    .attr("width", 9999)
    .attr("height", 9999);

d3.select('#js-storyworld').append("g");

// setup forces before rendering nodes and lines
var simulation = d3.forceSimulation()
    .force("link", d3.forceLink().id(function(d) { return d.id; }))
    .force("charge", d3.forceManyBody())
    .force("center", d3.forceCenter(width / 2, height / 2));

// makes the svg element zoomable
var zoom = d3.zoom()
  .scaleExtent([0.3, 2.5])
  .on('zoom', zoomFn);

function zoomFn() {
  d3.select('svg').select('g')
    .attr('transform', 'translate(' + d3.event.transform.x + ',' + d3.event.transform.y + ') scale(' + d3.event.transform.k + ')');
}
d3.select('svg').select('rect').call(zoom);

// check if JSON has a Storyworld
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

// Get facebook post and build JSON
function spawnNewStory(data) {
  var storyBuilder = [];
  var storyJSON = {nodes: storyBuilder, links: []};

  FB.api( '/me/posts', { access_token: data.token, fields:'id, picture, name'}, function(response) {
    if (response && !response.error) {
      response.data.forEach(function(entry){
        if (entry.picture) {
          storyBuilder.push({id: entry.id, name: entry.name, url:'https://facebook.com/'+ entry.id, image: entry.picture});
        } else {
          storyBuilder.push({id: entry.id, name: entry.name, url:'https://facebook.com/'+ entry.id, image: ''});
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
    }
  });
}

// load JSON and build links and nodes
function loadStory(graph) {
  var dataset = JSON.parse(graph.story);
  svg = d3.select('#js-storyworld').select("g");

  // Setup link to source and target
  var link = svg.append("g")
      .attr("class", "links")
      .selectAll("line")
      .data(dataset.links)
      .enter().append("line")
        .attr("stroke", "#415a77")
        .attr("stroke-width", "4px");

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

  node.append("defs")
  .append("rect")
    .attr("id", function(d) { return "rect_" + d.id })
    .attr("x", -25)
    .attr("y", -25)
    .attr("width", 50)
    .attr("height", 50)
    .attr("rx", "25");

  node.select("defs")
  .append("clipPath")
    .attr("id", function(d) { return "clip_" + d.id })
    .append("use")
      .attr("xlink:href", function(d) { return "#rect_" + d.id });

  // // random background color
  node.append("use")
    .attr("xlink:href", function(d) { return "#rect_" + d.id })
    .attr("stroke-width", "4px")
    .attr("stroke", "#415a77")
    .attr("fill", "#415a77");

  node.append("image")
    .attr("xlink:href", function(d) { return d.image })
    .attr("clip-path", function(d) { return "url(#clip_" + d.id + ")"})
    .attr("x", -40)
    .attr("y", -30)
    .attr("width", 80)
    .attr("height", 60);

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
  if (!d3.event.active)
  simulation.alphaTarget(0.3).restart();
  d.fx = d.x;
  d.fy = d.y;
}

function dragged(d) {
  d.fx = d3.event.x;
  d.fy = d3.event.y;
}

function dragended(d) {
  if (!d3.event.active)
  simulation.alphaTarget(0);
  d.fx = null;
  d.fy = null;
}

// onclick start Link Building
document.getElementById("js-new-link").onclick = function() {linkToggle()};

function linkToggle(){
  $('#js-new-link').text('exit');
  var source = '',
  target = '';
  svg.selectAll(".node").on("click", function() {

    if (source === '') {
      source = this.id;
      $('#js-source').toggleClass("active", true);
      $('#' + this.id).toggleClass("active", true);
    } else {
      if (source === this.id) {
        source = '';
        $('#js-source').toggleClass("active", false);
        $('#' + this.id).toggleClass("active", false);
      } else {
        if (target === this.id) {
          target = '';
          $('#js-target').toggleClass("active", false);
          $('#' + this.id).toggleClass("active", false);
        } else {
          target = this.id;
          $('#js-target').toggleClass("active", true);
          $('#' + this.id).toggleClass("active", true);
        }
      }
    }
  });


  document.getElementById("js-save-link").onclick = function() {  if ( source && target ) {buildLink(source, target) }};
}

function buildLink(Source, Target) {
  d3.json(pathname+'/get-page', function(graph) {
    var story = JSON.parse(graph.story);
    if (story.links.length == 0) {
      var linkBuilder = [];
    }else{
      var linkBuilder = story.links;
    };

    var storyJSON = {nodes: story.nodes, links: linkBuilder};

    linkBuilder.push({source: Source, target: Target});
    storyJSON = JSON.stringify(storyJSON);

    // sends the JSON to the database
    $.ajax({
      type: "POST",
      url: pathname+'/save-story',
      data: {storyJSON, '_token': $('input[name=_token]').val(), project},
      dataType: 'json',
      succes: location.reload()
    });
  });
}
