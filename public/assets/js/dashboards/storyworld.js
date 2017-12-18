
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

  d3.select('#js-storyworld')
    .attr("width", width)
    .attr("height", height);

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
  d3.select('svg').select('rect').call(zoom).on("dblclick.zoom", null);


  // filters go in defs element
  var defs = svg.append("defs");

  // create filter with id #drop-shadow
  // height=130% so that the shadow is not clipped
  var filter = defs.append("filter")
      .attr("id", "drop-shadow")
      .attr("height", "130%");

  // SourceAlpha refers to opacity of graphic that this filter will be applied to
  // convolve that with a Gaussian with standard deviation 3 and store result
  // in blur
  filter.append("feGaussianBlur")
      .attr("in", "SourceAlpha")
      .attr("stdDeviation", 4)
      .attr("result", "blur");

  // translate output of Gaussian blur to the right and downwards with 2px
  // store result in offsetBlur
  filter.append("feOffset")
      .attr("in", "blur")
      .attr("dx", 0)
      .attr("dy", 2)
      .attr("result", "offsetBlur");

  filter.append("feFlood")
     .attr("in", "offsetBlur")
     .attr("flood-color", "rgba(0, 0, 0, 0.2)")
     .attr("flood-opacity", "1")
     .attr("result", "offsetColor");

 filter.append("feComposite")
   .attr("in", "offsetColor")
   .attr("in2", "offsetBlur")
   .attr("operator", "in")
   .attr("result", "offsetBlur");

  // overlay original SourceGraphic over translated blurred opacity by using
  // feMerge filter. Order of specifying inputs is important!
  var feMerge = filter.append("feMerge");

  feMerge.append("feMergeNode")
      .attr("in", "offsetBlur")
  feMerge.append("feMergeNode")
      .attr("in", "SourceGraphic");


  svg = d3.select('#js-storyworld').select("g");

  // Setup link to source and target
  var link = svg.append("g")
      .attr("class", "links")
      .selectAll("line")
      .data(dataset.links)
      .enter().append("line")
        .attr("id", function(d) { return d.id })
        .attr("stroke", "rgba(255, 255, 255, 0.5)")
        .attr("stroke-width", "4px")
        .on("contextmenu", function() {d3.event.preventDefault(); deleteLink(this.id)});

  // Setup node
  var node = svg.selectAll(".node")
      .data(dataset.nodes)
      .enter().append("g")
        .attr("class", "node")
        .attr("id", function(d) { return d.id })
        // .style("filter", "url(#drop-shadow)")
        .on("contextmenu", function() {d3.event.preventDefault(); linkToggle(this.id)})
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
  // .attr("xlink:href", function(d){return d.url;})
  // .attr("target", "_blank")
  .attr("x", -25)
  .attr("y", -25)
  .attr("width", 50)
  .attr("height", 50)
  .on("contextmenu", function() {d3.event.preventDefault(); linkToggle(this.id)})
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
