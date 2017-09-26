//----------------------------FACEBOOK SPUL HIERONDER------------------------------//
// requests the data from social media in the database
var pathname = window.location.pathname;
var project = pathname.substr(11);
var links = "";

// make a new heading node
document.getElementById("js-new-heading").addEventListener("click", function () {
    svg = d3.select("#js-story-world").select("g");
    var headingName = prompt("Enter header name:", "");
    if (!idExists(headingName)) {
        if (headingName != null && headingName != "") {spawnHeading(svg, headingName, 0, 0, null);}
    }
});

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
    $.getJSON(pathname+'/get-page', function(data) {
        getPosts(data);
        initStoryWorld(data);
    });
};

/* Connect the page with facbook sdk libary
 *
 * @id (int) id of our facebook-app
 * @d & s (?) i have no clue
 */
(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function loginCheck(){
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            console.log('Check: Logged in.');
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
            document.location.reload();
        }
        else{
            window.location.replace("/story-list");
            console.log('Login: User cancelled login or did not fully authorize.');
        }
    }, {
        scope: 'manage_pages',
        return_scopes: true
    });
}
/* logout
 *
 * logout from facebook on this site
 *
 */
function logout_fb() {
    console.log('Logout: function logout is called');
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            FB.logout(function(response) {
                console.log('Logout: user is logged out');
                document.location.reload();
            });
        }
        else{
            console.log('Logout: user wasn\'t logged in');
        }
    });
}

// gets the posts from facebook using the connected access token and places them in the view
function getPosts(data){
    page_access_token = data.token;
    FB.api( '/me/posts', { access_token: page_access_token, fields:'message,picture,likes,shares,comments,created_time'}, function(response) {
        var postContainer = document.getElementById("posts");
        var count = 0;
        $( ".spinner" ).hide();

        response.data.forEach(function(entry){
            var likes = '';
            var comments = '';
            var shares = '';

            var output = "<div class='post'><div class='line'></div><div class='content'><div class='above'>";

            // left above - image
            output += '<div class="left">';
            if (response.data[count].picture == null){
                output += '<div class="image" style="background-image:url(http://via.placeholder.com/100x100)"></div>';
            }else{
                output += '<div class="image" style="background-image:url('+response.data[count].picture+')"></div>';
            }
            output += '</div>';

            // right above - stats
            output += '<div class="right">';

            var date = new Date(response.data[count].created_time)
            output += '<div class="date">' + formatDate(date) + '</div>';

            if (response.data[count].likes == null){
                likes = 0;
            }
            else{
                likes = response.data[count].likes.data.length;
            }

            if (response.data[count].comments == null){
                comments = 0;
            }
            else{
                comments = response.data[count].comments.data.length;
            }

            if (response.data[count].shares == null){
                shares = 0;
            }
            else{
                shares = response.data[count].shares.count;
            }

            output += '<div class="stats">'
            output += "<table><tr><th><i class='icon-thumbs-o-up'></i></th><th><i class='icon-comment-o'></i></th><th><i class='icon-eye'></i></th></tr><tr><td>"+ likes +"</td><td>"+ comments +"</td><td>"+ shares +"</td></tr></table>";
            output += '</div></div>';

            output += "</div> <div class='under'>";
            // left under - text
            if (response.data[count].message){
                output += "<div class='left'>" + response.data[count].message.slice(0,50) + "...</div>";
            }else{
                output += "<div class='left'></div>";
            }
            // right under - button
            output += "<div class='right'>" + "<a target='_blank' href='http://www.facebook.com/"+entry.id+"' class='icon-arrow-circle-right'></a> " + "</div>";

            output += "</div></div>";

        postContainer.innerHTML += output;
        count++;
      });
  });
}

//show date in correct format
function formatDate(date) {
  var monthNames = [
    "January", "February", "March",
    "April", "May", "June", "July",
    "August", "September", "October",
    "November", "December"
  ];

  var day = date.getDate();
  var monthIndex = date.getMonth();
  var year = date.getFullYear();

  return day + ' ' + monthNames[monthIndex] + ' ' + year;
}

// saves the token in connect social media, token = the token of the page the user selects when connecting
function saveToken(token, name){
    var token_input = document.getElementById('token_input');
    var name_input = document.getElementById('name_input');
    var index_input = document.getElementById('index_input');
    token_input.value = token;
    name_input.value = name;
    index_input.value = '0';
}

//
// D3.js starts here
// Storyworld 
//


// initializes the storyworld
function initStoryWorld(data) {
    page_name = data.name;
    svg = d3.select('#js-story-world');

    // filters and patterns go in defs element
    var defs = svg.append("defs");
    dropShadow(defs);

    // adds the zoomable area
    svg.select("rect")
        .attr("x", -2000)
        .attr("y", -2000)
        .attr("width", 9999)
        .attr("height", 9999);

    d3.select('#js-story-world').append("g");
    svg = d3.select('#js-story-world').select("g");

    // if there is a story already saved, load it, else create a new one
    if (!data.story) {
        spawnHeading(svg, page_name, 0, 0);
        spawnPostsCluster(data);
    }
    else{
        story = JSON.parse(data.story);
        loadStory(svg, story);
    }
}

// makes the svg element zoomable
var zoom = d3.zoom()
  .scaleExtent([1, 100])
  .on('zoom', zoomFn);

function zoomFn() {
  d3.select('svg').select('g')
    .attr('transform', 'translate(' + d3.event.transform.x + ',' + d3.event.transform.y + ') scale(' + d3.event.transform.k + ')');
}
d3.select('svg').select('rect').call(zoom);

// creates a new cluster of posts around the header node
function spawnPostsCluster(data) {
    FB.api( '/me/posts', { access_token: data.token, fields:'id, picture'}, function(response) {
        response.data.forEach(function(entry){
            // creates a new group
            var id = "id_" + entry.id;
            var posX = d3.randomUniform(-600, 600)();
            var posY = d3.randomUniform(-450, 450)();

            spawnPost(svg, id, posX, posY);

            var header = d3.select(".heading");
            var headerId = header.attr("id");

            links = connectNodes(headerId, id, links);
        });
    });
}

// connect two nodes together
function connectNodes(id1, id2, links) {
    if (id1.charAt(0) != "#") {
        id1 = "#" + id1;
    }
    if (id2.charAt(0) != "#") {
        id2 = "#" + id2;
    }

    origin = d3.select(id1);
    target = d3.select(id2).select("circle");

    origin.append("line")
        .attr("x1", origin.select("circle").attr("cx"))
        .attr("y1", origin.select("circle").attr("cy"))
        .attr("x2", target.attr("cx"))
        .attr("y2", target.attr("cy"))
        .attr("stroke-width", 8)
        .attr("stroke", "#7086b4")
        .lower();

    if (links == null || links == "") {
        var links = '{"origin" : "'+id1+'", "target" : "'+id2+'"}';
    }
    else{
        links += ',{"origin" : "'+id1+'", "target" : "'+id2+'"}';
    }

    return links;
}

// saves all positions of the story nodes to the database
function saveStory() {
    var allNodes = svg.nodes()[0].childNodes;
    var storyJSON = [];
    linksJSON = '{ "story":['+links+']}';

    $.each(allNodes, function () {
        // makes sure it doesn't save text, buttons etc.
        // pushes each node into a single JSON with the necessary attributes
        if ((this.id) && (this.classList.contains("post-node"))) {
            storyJSON.push({id : this.id,
                type:'post',
                posX: this.childNodes[0].getAttribute("cx"),
                posY: this.childNodes[0].getAttribute("cy")});
        }
        if ((this.id) && (this.classList.contains("heading"))) {
            storyJSON.push({id : this.id,
                type:'head',
                posX: this.childNodes[0].getAttribute("cx"),
                posY: this.childNodes[0].getAttribute("cy")});
        }
    });
    storyJSON = JSON.stringify(storyJSON);

    // sends the JSON to the database
    $.ajax({
        type: "POST",
        url: pathname+'/save-story',
        data: {linksJSON, storyJSON, '_token': $('input[name=_token]').val(), project},
        dataType: 'json'
    });
}

// goes through the JSON and spawns each node depending on the type
function loadStory(svg, story) {
    $.each(story, function () {
        if (this.type == 'post') {
            spawnPost(svg, this.id, this.posX, this.posY, this.links);
        }
        if (this.type == 'head') {
            spawnHeading(svg, this.id, this.posX, this.posY, this.links);
        }
    })
}

// create a new heading node using specified name, position and links
function spawnHeading(svg, name, posX, posY) {
    name = name.split("_").pop();
    name = name.replace(/\s+/g, '_');
    var id = "#" + name;
    var text = name.replace(/_/g, ' ');

    svg.append("g")
        .attr("x", posX)
        .attr("y", posY)
        .attr("transform", "scale(0)")
        .classed("heading", true)
        .attr("id", name);

    heading = d3.select(id);

    heading.append("circle")
        .attr("r", 100)
        .attr("cx", posX)
        .attr("cy", posY)
        .classed("heading-circle", true);

    heading.append("text")
        .attr("x", posX)
        .attr("y", posY)
        .attr("dx", this.x)
        .attr("dy", this.y)
        .text(text)
        .classed("heading-text", true);

    // makes the nodes draggable
    d3.selectAll(".heading").call(d3.drag().on("start", started));

    // remove the node on double click
    headingDOM = document.getElementById(name);
    headingDOM.addEventListener("dblclick", function () {
        if (confirm("Delete this header and all links?")) {
            removeNode(id);
        }
    });
    saveStory();

    // makes a fancy animation
    var t = d3.transition()
        .duration(750)
        .ease(d3.easeElastic);

    d3.selectAll(".heading")
        .transition(t)
        .attr("transform", "scale(1)");
}

function spawnPost(svg, id, posX, posY) {
    // creates a new group
    svg.append("g")
        .attr("transform", "scale(0)")
        .classed("post-node", true)
        .attr("id", id);

    postId = "#" + id;
    postNode = d3.select(postId);

    // adds a circle to the group
    postNode.append("circle")
        .attr("r", 0)
        .attr("cx", posX)
        .attr("cy", posY)
        .classed("post-circle", true)
        .on("contextmenu", function (d, i) {
            d3.event.preventDefault();
            var thisPost = d3.select(this);
            var thisGroup = d3.select(this.parentNode);

            thisPost.attr("stroke-width", "1.5rem");
            thisPost.classed("selected-menu", true);

            // toggles the buttons to invisible or not, when right clicked
            d3.select(this.parentNode).selectAll(".button-top")
                .classed("invisible", function (d, i) {
                    return !d3.select(this).classed("invisible");
                });
            d3.select(this.parentNode).selectAll(".button-left")
                .classed("invisible", function (d, i) {
                    return !d3.select(this).classed("invisible");
                });
            d3.select(this.parentNode).selectAll(".button-bottom")
                .classed("invisible", function (d, i) {
                    return !d3.select(this).classed("invisible");
                });
         });

        var thisPost = d3.select(postId).select(".post-circle");

    postNode.append("text")
        .attr("x", posX)
        .attr("y", posY)
        .attr("dx", this.x)
        .attr("dy", this.y)
        .text("Post")
        .classed("heading-text", true);

    // adds the buttons when right clicked
    postNode.append("circle")
        .attr("cy", function (d, i) {
            return parseInt(thisPost.attr("cy")) - 50;
        })
        .attr("cx", thisPost.attr("cx"))
        .attr("r", 20)
        .attr("fill", "#7086b4")
        .classed("button-top", true)
        .classed("invisible", true);

    postNode.append("circle")
        .attr("cx", function (d, i) {
            return parseInt(thisPost.attr("cx")) + 50;
        })
        .attr("cy", thisPost.attr("cy"))
        .attr("r", 20)
        .attr("fill", "#7086b4")
        .classed("button-left", true)
        .classed("invisible", true);

    postNode.append("circle")
        .attr("cy", function (d, i) {
            return parseInt(thisPost.attr("cy")) + 50;
        })
        .attr("cx", thisPost.attr("cx"))
        .attr("r", 20)
        .attr("fill", "#7086b4")
        .classed("button-bottom", true)
        .classed("invisible", true);

    d3.selectAll(".post-node").call(d3.drag().on("start", started));

    postDOM = document.getElementById(id);
    postDOM.addEventListener("dblclick", function () {
        fbId = id.split("id_").pop();
        url = "https://www.facebook.com/"+fbId;
        var win = window.open(url, '_blank');
        win.focus();
    });
    saveStory();

    // fancy animation
    var t = d3.transition()
        .duration(750)
        .ease(d3.easeElastic);

    d3.selectAll(".post-node")
        .transition(t)
        .attr("transform", "scale(1)");
}

// checks if an id exists before making a node
function idExists(id) {
    checkId = document.getElementById(id);
    if (checkId != null) {
        return true;
    }
    else{
        return false;
    }
}

// removes node with an animation and saves story
function removeNode(id) {
    var t = d3.transition()
        .duration(750)
        .ease(d3.easeExp);

    heading = d3.select(id);

    heading.selectAll("circle, text")
        .transition(t)
        .attr("transform", "scale(0)");

    setTimeout(function(){
        heading.remove();
        saveStory();
    }, 751);
}

// adds a simple drop shadow to the story world. isn't SVG fun!
function dropShadow(defs) {
    var filter = defs.append("filter")
    .attr("id", "drop-shadow")
    .attr("height", "150%")
    .attr("width", "150%");

    filter.append("feGaussianBlur")
        .attr("in", "SourceAlpha")
        .attr("stdDeviation", 2)
        .attr("result", "blur");

    var feMerge = filter.append("feMerge");

    feMerge.append("feMergeNode")
        .attr("in", "offsetBlur")
    feMerge.append("feMergeNode")
        .attr("in", "SourceGraphic");
}

// started dragging of point
function started() {
    var group = d3.select(this).classed("dragging", true);
    var circle = d3.select(this).select(".post-circle");
    var head = d3.select(this).select(".heading-circle");
    var text = d3.select(this).select("text");
    var link = d3.select(this).selectAll("line");

    var linkEnd = d3.select

    var topButton = d3.select(this).select(".button-top");
    var leftButton = d3.select(this).select(".button-left");
    var bottomButton = d3.select(this).select(".button-bottom");

    circle.classed("selectedMenu", false);
    circle.classed("dragging", true);
    d3.event.on("drag", dragged).on("end", ended);

    function dragged(d) {
        // updates the coordinates of each part of the node
        group
            .attr("x", d3.event.fx = d3.event.x)
            .attr("y", d3.event.fy = d3.event.y);
        circle.raise()
            .attr("cx", d3.event.fx = d3.event.x)
            .attr("cy", d3.event.fy = d3.event.y);
        head.raise()
            .attr("cx", d3.event.fx = d3.event.x)
            .attr("cy", d3.event.fy = d3.event.y);
        text.raise()
            .attr("x", d3.event.fx = d3.event.x)
            .attr("y", d3.event.fy = d3.event.y);
        link.lower()
            .attr("x1", d3.event.fx = d3.event.x)
            .attr("y1", d3.event.fy = d3.event.y);
        topButton.raise()
            .attr("cx", d3.event.fx = d3.event.x)
            .attr("cy", d3.event.fy = parseInt(d3.event.y - 50));
        leftButton.raise()
            .attr("cy", d3.event.fy = d3.event.y)
            .attr("cx", d3.event.fx = parseInt(d3.event.x + 50));
        bottomButton.raise()
            .attr("cx", d3.event.fx = d3.event.x)
            .attr("cy", d3.event.fy = parseInt(d3.event.y + 50));
    }

    function ended() {
        // removes the .dragging class when not dragging anymore
        group.classed("dragging", false);
        circle.classed("dragging", false);
        saveStory();
    }
}
