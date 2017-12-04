// ---------------------------------
//
//          Variables
//         & Triggers
//
// ----------------------------------

// variables
var pathname = window.location.pathname,
    project = pathname.substr(11),
    newURL = window.location.protocol + "//" + window.location.host + "/",
    chapterColor = '#A73C5A',
    FacebookColor = '#3b5998';

// triggers
window.onload = function() {

  var trigger = new Trigger();
  trigger.findTrigger();
};

// linkToggle
document.getElementById("js-new-link").onclick = function() {
  $(this).toggleClass("active");

  if ($(this).text() == "Close") {
    $(this).text("Link nodes")
  } else {
    $(this).text("Close");
    linkToggle()
  }
};

// addChapter
document.getElementById("js-chapter").onclick = function() {
  $(this).toggleClass("active");
  $('#chapter-input').toggleClass("active");

  if ($(this).text() == "Close") {
    $(this).text("Add chapter")
  } else {
    $(this).text("Close");
    addChapter()
  }
};

// reloadStory
document.getElementById("js-refresh").onclick = function() {
  d3.json(pathname+'/get-page', function(graph) {
    reloadStory(graph);
  });
};

// ---------------------------------
//
//          Facebook API
//         Powered by FB
//
// ----------------------------------

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
          console.log("please login to Facebook");
          return false;
      }
  });
}

// ---------------------------------
//
//          JSON building
//        Powered by Code
//
// ----------------------------------

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

// Get  post and build JSON
function spawnNewStory(data) {
  var storyBuilder = [];
  var storyJSON = {nodes: storyBuilder, links: [], chapters: []};

  FB.api( '/me/posts', { access_token: data.token, fields:'id, name'}, function(response) {
    if (response && !response.error) {
      response.data.forEach(function(entry){
        storyBuilder.push({
          id: 'fb_' + entry.id,
          name: entry.name,
          url:'https://facebook.com/'+ entry.id,
          image: newURL+ 'assets/img/facebook-app-logo.svg',
          stroke: FacebookColor,
          fill: FacebookColor
        });
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

// addChapter
function addChapter() {
  var d = new Date(),
  n = d.getTime(),
  chapterTitle = $('input[name=_chapter]').val('');

  document.getElementById("js-save-chapter").onclick = function() {

    chapterTitle = $('input[name=_chapter]').val();

    if (chapterTitle !== '') {

      d3.json(pathname+'/get-page', function(graph) {
        var story = JSON.parse(graph.story);

        // check chapter in storyworld
        if (story.chapters.length == 0) {
          var chapterBuilder = [];
        }else{
          var chapterBuilder = story.chapters;
        }

        // check nodes in storyworld
        if (story.nodes.length == 0) {
          var storyBuilder = [];
        }else{
          var storyBuilder = story.nodes;
        }

        // check link in storyworld
        if (story.links.length == 0) {
          var linkBuilder = [];
        }else{
          var linkBuilder = story.links;
        }

        var storyJSON = {nodes: storyBuilder, links: linkBuilder, chapters: chapterBuilder};

        chapterBuilder.push({
          id: 'ch_' + n,
          name: chapterTitle,
          url:'',
          image: newURL+ 'assets/img/chapter.svg',
          stroke: chapterColor,
          fill: chapterColor
        });
        storyBuilder.push({
          id: 'ch_' + n,
          name: chapterTitle,
          url:'',
          image: newURL+ 'assets/img/chapter.svg',
          stroke: chapterColor,
          fill: chapterColor
        });

        storyJSON = JSON.stringify(storyJSON);

        // // sends the JSON to the database
        $.ajax({
          type: "POST",
          url: pathname+'/save-story',
          data: {storyJSON, '_token': $('input[name=_token]').val(), project},
          dataType: 'json',
          succes: location.reload()
        });
      });
    }
  };
}

// linkToggle
function linkToggle(){
  var source = '',
  svg = d3.select('#js-storyworld').select("g"),
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

// buildLink
function buildLink(Source, Target) {
  d3.json(pathname+'/get-page', function(graph) {
    var story = JSON.parse(graph.story);

    // check chapter in storyworld
    if (story.chapters.length == 0) {
      var chapterBuilder = [];
    }else{
      var chapterBuilder = story.chapters;
    }

    // check nodes in storyworld
    if (story.nodes.length == 0) {
      var storyBuilder = [];
    }else{
      var storyBuilder = story.nodes;
    }

    // check link in storyworld
    if (story.links.length == 0) {
      var linkBuilder = [];
    }else{
      var linkBuilder = story.links;
    }

    var storyJSON = {nodes: storyBuilder, links: linkBuilder, chapters: chapterBuilder};

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

// reloadStory
function reloadStory(data) {
  var story = JSON.parse(data.story);
  var storyBuilder = [];

  // check chapter in storyworld
  if (story.chapters.length == 0) {
    var chapterBuilder = [];
  }else{
    var chapterBuilder = story.chapters;
  }

  // check link in storyworld
  if (story.links.length == 0) {
    var linkBuilder = [];
  }else{
    var linkBuilder = story.links;
  }

  var storyJSON = {nodes: storyBuilder, links: linkBuilder, chapters: chapterBuilder};

  chapterBuilder.forEach( function(i) {
    storyBuilder.push({
      id: i.id,
      name: i.name,
      url: i.url,
      image: i.image,
      stroke: i.stroke,
      fill: i.fill
    });
  })

  FB.api( '/me/posts', { access_token: data.token, fields:'id, name'}, function(response) {
    if (response && !response.error) {
      response.data.forEach(function(entry){
          storyBuilder.push({
            id: 'fb_' + entry.id,
            name: entry.name,
            url:'https://facebook.com/'+ entry.id,
            image: newURL+ 'assets/img/facebook-app-logo.svg',
            stroke: FacebookColor,
            fill: FacebookColor
          });
      });
    }

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

// ---------------------------------
//
//       StoryWorld Building
//        Powered by D3.js
//
// ----------------------------------


// load JSON and build links and nodes
function loadStory(graph) {
  var dataset = JSON.parse(graph.story);

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


  var repelForce = d3.forceManyBody().strength(-140).distanceMax(60).distanceMin(10);

  var attractForce = d3.forceManyBody().strength(-100).distanceMax(100).distanceMin(60);

  // setup forces before rendering nodes and lines
  var simulation = d3.forceSimulation(dataset.nodes)
      .force("repelForce",repelForce)
      .force("attractForce",attractForce)
      .force("link", d3.forceLink(dataset.links).id(function(d) { return d.id; }))
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
    .attr("stroke", function(d) { return d.stroke })
    .attr("fill", function(d) { return d.fill });

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

  simulation.nodes(dataset.nodes).on("tick", ticked);

  simulation.force("link").links(dataset.links).distance(120);


  function ticked() {
    link
        .attr("x1", function(d) { return d.source.x; })
        .attr("y1", function(d) { return d.source.y; })
        .attr("x2", function(d) { return d.target.x; })
        .attr("y2", function(d) { return d.target.y; });

    node.attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });
  }

  function dragstarted(d) {
    simulation.restart();
    simulation.alpha(1.0);
    d.fx = d.x;
    d.fy = d.y;
  }

  function dragged(d) {
    d.fx = d3.event.x;
    d.fy = d3.event.y;
  }

  function dragended(d) {
    simulation.alphaTarget(0.1);
    d.fx = null;
    d.fy = null;
  }
}
