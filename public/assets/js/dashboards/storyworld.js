
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
      width =  window.innerWidth,
      height = window.innerHeight;

  d3.select("#js-storyworld")
    .style("width", width + 'px')
    .style("height", height + 'px')
    .append("div")
      .attr("id", "js-world");

  // drag to move around the storywold
  var zoom = d3.zoom()
  // .scaleExtent([0.3, 2.5])
  .on('zoom', zoomFn);

  function zoomFn() {
    d3.select('svg').select('g')
      .attr('transform', 'translate(' + d3.event.transform.x + ',' + d3.event.transform.y + ')');
    //
    d3.select("#js-world")
      .style("transform", function(d) {return 'translate(' + d3.event.transform.x + 'px,' + d3.event.transform.y + 'px)';});
  }

  d3.select('svg').select('rect').call(zoom).on("dblclick.zoom", null);

  d3.select("#js-storyworld").call(zoom).on("dblclick.zoom", null);


  var repelForce = d3.forceManyBody().strength(-140).distanceMax(100).distanceMin(10);

  var attractForce = d3.forceManyBody().strength(-100).distanceMax(100).distanceMin(60);

  // setup forces before rendering nodes and lines
  var simulation = d3.forceSimulation(dataset.nodes)
      .force("repelForce",repelForce)
      .force("attractForce",attractForce)
      .force("link", d3.forceLink(dataset.links).id(function(d) { return d.id; }))
      .force("center", d3.forceCenter(width / 2, height / 2));

  svg = d3.select('#js-world');

  // Setup node
  var node = svg.append("div")
      .attr("class", "nodes")
      .selectAll(".node")
      .data(dataset.nodes)
      .enter().append("div")
        .attr("class", "node")
        .attr("id", function(d) { return d.type })
        .style("left", function(d) { return d.x + "px"; })
        .style("top", function(d) { return d.y + "px"; })
        .style("transform", "translate(" + -50 + "px," + -50 + "px)")
        .call(d3.drag()
          .on("start", dragstarted)
          .on("drag", dragged)
          .on("end", dragended));

  node.append("div")
    .attr("id", function(d) { return d.id })
    .attr("class", "node-image")
    .style("width", 100 + "px")
    .style("height", 100 + "px")
    .on("contextmenu", function() {d3.event.preventDefault(); linkToggle(this.id)})
    .on("click", function() {deleteNode(this.id)})

  node.append("p")
    .attr("class", "node-text")
    .attr("id", function(d) { return "text_" + d.id })
    .on("dblclick", function() {renameChapter(this.id)})
    .text(function(d) { return d.name });


  d3.select('#js-storyworld').append("svg");
  svg = d3.select('#js-storyworld').select("svg")
    .attr("width", width)
    .attr("height", height)

  svg.append("rect")
    .attr("class", "zoom-layer")
    .attr("x", -2000)
    .attr("y", -2000)
    .attr("width", 9999)
    .attr("height", 9999);

  // Setup link to source and target
  var link = svg.append("g")
      .attr("class", "links")
      .selectAll("line")
      .data(dataset.links)
      .enter().append("line")
        .attr("class", "link")
        .attr("id", function(d) { return d.id })
        .attr("stroke", "rgba(255, 255, 255, 0.5)")
        .attr("stroke-width", "4px")
        .on("contextmenu", function() {d3.event.preventDefault(); deleteLink(this.id)});

  simulation.nodes(dataset.nodes).on("tick", ticked);

  simulation.force("link").links(dataset.links).distance(160);


  function ticked() {

    link
        .attr("x1", function(d) { return (d.source.x); })
        .attr("y1", function(d) { return (d.source.y); })
        .attr("x2", function(d) { return (d.target.x); })
        .attr("y2", function(d) { return (d.target.y); });

    node
      .style("left", function(d) {return d.x + 'px';})
      .style("top", function(d) {return d.y + 'px';});
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
