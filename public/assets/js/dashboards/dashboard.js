// ---------------------------------
//
//          Variables
//         & Triggers
//
// ----------------------------------

// variables
var pathname = window.location.pathname,
    project = pathname.substr(11),
    newURL = window.location.protocol + "//" + window.location.host + "/";

// triggers
window.onload = function() {
  var trigger = new Trigger();
  trigger.findTrigger();
};

// add chapter button
document.getElementById("js-chapter").onclick = function() {
  addChapter()
};

// delete chapter button
document.getElementById("js-delete-chapter").onclick = function() {
  var id = $('input[name=_node]').val();
  deleteChapter(id);
};

// reload storyworld button
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
  // reset values on reload and all
  //console.log($('body').css());

  $('#js-delete-chapter').toggleClass("active", false);
  $('input[name=_node]').val('');

  d3.json(pathname+'/get-page', function(graph) {
    var story = JSON.parse(graph.story);

    if (!story) {
        spawnNewStory(graph);
        
    }
    else{
        loadStory(graph);
        getNodePosition();
    }
  });
}

// Get  post and build JSON
function spawnNewStory(data) {
  var storyBuilder = [];
  var storyJSON = {nodes: storyBuilder, links: [], chapters: []};

  FB.api( '/me/posts', { access_token: data.token, fields:'id, name, likes, shares, comments'}, function(response) {
    if (response && !response.error) {
      response.data.forEach(function(entry){
        storyBuilderPush(entry, storyBuilder);
      });

      storyJSON = JSON.stringify(storyJSON);

      // sends the   JSON to the database
      pushToBackend(storyJSON);

      initStoryWorld();
    }
  });
}

// ---------------
// Chapter logica
// ---------------

// addChapter
function addChapter() {
  var d = new Date(),
  n = d.getTime(),
  chapterTitle = "Title";

  if (chapterTitle !== '') {

    d3.json(pathname+'/get-page', function(graph) {
      var story = JSON.parse(graph.story);

      // check chapter in storyworld
      if (story.chapters) { var chapterBuilder = story.chapters; }else{ var chapterBuilder = []; }

      // check nodes in storyworld
      if (story.nodes) { var storyBuilder = story.nodes; }else{ var storyBuilder = []; }

      // check link in storyworld
      if (story.links) { var linkBuilder = story.links; }else{ var linkBuilder = []; }

      var storyJSON = {nodes: storyBuilder, links: linkBuilder, chapters: chapterBuilder};

      chapterBuilder.push({
        id: 'ch_' + n,
        type: 'ch',
        name: chapterTitle,
        url:'',
        image: newURL+ 'assets/img/chapter.svg'
      });
      storyBuilder.push({
        id: 'ch_' + n,
        type: 'ch',
        likes: 8,
        comments: 8,
        shares: 8,
        name: chapterTitle,
        url:'',
        image: newURL+ 'assets/img/chapter.svg'
      });

      storyJSON = JSON.stringify(storyJSON);

      // sends the JSON to the database
      pushToBackend(storyJSON);
    });
  }
}

function renameChapter(id) {
  var pattern = /ch/,
      exists = pattern.test(id)
      title = $('#' + id).text();

  if (exists) {
    $("body").on( "keydown", function(event) {
      // enter key
      if(event.which === 13){
          title = $('#' + id).text();
          pushRenameChapter(id, title);
          $("body").off( "keydown");
      } else {
        // backspace key
        if(event.which === 8){
          event.preventDefault();
          backSpace();
        } else {
          let chr = String.fromCharCode(event.which);
          $('#' + id).append(chr.toLowerCase())
        }
      }
    });

    // verwijderen van characters
    function backSpace(){
      title = $('#' + id).text();
      $('#' + id).text(title.substr(0, title.length - 1));
    }
  }

}

function pushRenameChapter(id, title) {
  var id = id.slice(5);

  d3.json(pathname+'/get-page', function(graph) {
    var story = JSON.parse(graph.story);

    // check chapter in storyworld
    if (story.chapters) { var chapterBuilder = story.chapters; }else{ var chapterBuilder = []; }

    // check nodes in storyworld
    if (story.nodes) { var storyBuilder = story.nodes; }else{ var storyBuilder = []; }

    // check link in storyworld
    if (story.links) { var linkBuilder = story.links; }else{ var linkBuilder = []; }

    // find chapter with id and change title
    var dataChapter = $.grep(chapterBuilder, function(e){ return e.id == id;});

    if(dataChapter && dataChapter.length == 1) {
      dataChapter[0].name = title;
    }

    // find story with id and change title
    var dataStory = $.grep(storyBuilder, function(e){ return e.id == id;});

    if(dataStory && dataStory.length == 1) {
      dataStory[0].name = title;
    }

    var storyJSON = {nodes: storyBuilder, links: linkBuilder, chapters: chapterBuilder};

    storyJSON = JSON.stringify(storyJSON);

    // sends the JSON to the database
    pushToBackend(storyJSON);
  });
}

// Delete link
function deleteChapter(id) {
  d3.json(pathname+'/get-page', function(graph) {
    var story = JSON.parse(graph.story);

    // check chapter in storyworld
    if (story.chapters) { var chapterBuilder = story.chapters; }else{ var chapterBuilder = []; }

    // check nodes in storyworld
    if (story.nodes) { var storyBuilder = story.nodes; }else{ var storyBuilder = []; }

    // check link in storyworld
    if (story.links) { var linkBuilder = story.links; }else{ var linkBuilder = []; }

    // Find chapter with id and exclude from new array
    var dataChapter = $.grep(chapterBuilder, function(e){ return e.id != id;});
    chapterBuilder = dataChapter;

    // Find chapter with id and exclude from new array
    var dataStory = $.grep(storyBuilder, function(e){ return e.id != id;});
    storyBuilder = dataStory;

    // Find link with id and exclude from new array
    var dataLink = $.grep(linkBuilder, function(e){
      if (e.source != id) { if (e.target != id) {return e;} }
    });

    linkBuilder = dataLink;

    var storyJSON = {nodes: storyBuilder, links: linkBuilder, chapters: chapterBuilder};

    storyJSON = JSON.stringify(storyJSON);

    // sends the JSON to the database
    pushToBackend(storyJSON);
  });
}

// ------------
// Link logica
// ------------

// linkToggle
function linkToggle(id) {
  var source = $('input[name=_source]').val(),
      target = $('input[name=_target]').val();

  if (source === '') {
    source = $('input[name=_source]').val(id);
    $('#' + id).toggleClass("active", true);
  } else {
    target = $('input[name=_target]').val(id);
    $('#' + id).toggleClass("active", true);
  }

  if (source && target) {
    buildLink($('input[name=_source]').val(), $('input[name=_target]').val())
  };
}

// buildLink
function buildLink(Source, Target) {
  d3.json(pathname+'/get-page', function(graph) {
    var story = JSON.parse(graph.story);

    // check chapter in storyworld
    if (story.chapters) { var chapterBuilder = story.chapters; }else{ var chapterBuilder = []; }

    // check nodes in storyworld
    if (story.nodes) { var storyBuilder = story.nodes; }else{ var storyBuilder = []; }

    // check link in storyworld
    if (story.links) { var linkBuilder = story.links; }else{ var linkBuilder = []; }

    var storyJSON = {nodes: storyBuilder, links: linkBuilder, chapters: chapterBuilder},
    d = new Date(),
    n = d.getTime();

    linkBuilder.push({id: 'lk_' + n, source: Source, target: Target});
    storyJSON = JSON.stringify(storyJSON);

    // sends the JSON to the database
    pushToBackend(storyJSON);
  });
  // reset value of input on page load
  $('input[name=_source]').val('');
  $('input[name=_target]').val('');

}

// Delete link
function deleteLink(id) {
  d3.json(pathname+'/get-page', function(graph) {
    var story = JSON.parse(graph.story);

    // check chapter in storyworld
    if (story.chapters) { var chapterBuilder = story.chapters; }else{ var chapterBuilder = []; }

    // check nodes in storyworld
    if (story.nodes) { var storyBuilder = story.nodes; }else{ var storyBuilder = []; }

    // check link in storyworld
    if (story.links) { var linkBuilder = story.links; }else{ var linkBuilder = []; }

    // Find link with id and exclude from new array
    var data = $.grep(linkBuilder, function(e){ return e.id != id;});
    linkBuilder = data;

    var storyJSON = {nodes: storyBuilder, links: linkBuilder, chapters: chapterBuilder};

    storyJSON = JSON.stringify(storyJSON);

    // sends the JSON to the database
    pushToBackend(storyJSON);
  });
}


// --------------
// other logica
// --------------

// delete nodes
function deleteNode(id) {
  var pattern = /ch/,
      exists = pattern.test(id),
      deleted = $('input[name=_node]').val();

  // if it is a chapter toggle button
  if (exists) {
    if (deleted === id) {
      $('#js-delete-chapter').toggleClass("active", false);
      $('#' + id).toggleClass("active", false);
      $('input[name=_node]').val('');
    } else {
      if ($('#js-delete-chapter').hasClass('active')) {
        $('#' + id).toggleClass("active", false);
        $('#js-delete-chapter').toggleClass("active", false);
        $('#' + deleted).toggleClass("active", false);
        $('input[name=_node]').val('');
      } else {
        $('#' + id).toggleClass("active", true);
        $('#js-delete-chapter').toggleClass("active", true);
        $('input[name=_node]').val(id);
      }
    }
  }
}

// reloadStory
function reloadStory(data) {
  var story = JSON.parse(data.story);

  // check chapter in storyworld
  if (story.chapters) { var chapterBuilder = story.chapters; }else{ var chapterBuilder = []; }

  // check nodes in storyworld
  var storyBuilder = [];

  // check link in storyworld
  if (story.links) { var linkBuilder = story.links; }else{ var linkBuilder = []; }

  var storyJSON = {nodes: storyBuilder, links: linkBuilder, chapters: chapterBuilder};

  chapterBuilder.forEach( function(entry) {
    storyBuilder.push({
      id: entry.id,
      type: entry.type,
      likes: 8,
      comments: 8,
      shares: 8,
      name: entry.name,
      url: entry.url,
      image: entry.image
    });
  })

  FB.api( '/me/posts', { access_token: data.token, fields:'id, name, likes, shares, comments'}, function(response) {
    if (response && !response.error) {
      response.data.forEach(function(entry){
          storyBuilderPush(entry, storyBuilder);
      });
    }
    storyJSON = JSON.stringify(storyJSON);

    // sends the JSON to the database
    pushToBackend(storyJSON);
  });
}

// A function to push an array in to the JSON for storyBuilder
function storyBuilderPush(entry, storyBuilder) {
  var l = 0,
      c = 0,
      s = 0,
      n = 'Post';

  if (entry.likes) {l = entry.likes.data.length;};
  if (entry.comments) {c = entry.comments.data.length;};
  if (entry.shares) {s = entry.shares.count;};
  if (entry.name) {n = entry.name;};

  storyBuilder.push({
    id: 'fb_' + entry.id,
    type: 'fb',
    name: n,
    likes: l,
    comments: c,
    shares: s,
    url:'https://facebook.com/'+ entry.id,
    image: newURL+ 'assets/img/facebook-app-logo.svg'
  });
}

// A function to send the storyworld to the database
function pushToBackend (storyJSON) {
  $.ajax({
    type: "POST",
    url: pathname+'/save-story',
    data: {storyJSON, '_token': $('input[name=_token]').val(), project},
    dataType: 'json'
  });
  // remove svg components otherwise it would just add more.
  $("#js-storyworld").find("*").not("rect").remove();
  initStoryWorld()
}

//
function growthHacker(l, s, c) {

  function likes(l) {
    var a = 10;
    var b = a * Math.sqrt(l);
    return b;
  }

  function shares(s) {
    var a = 12;
    var b = a * Math.sqrt(l);
    return b;
  }

  function comments(c) {
    var a = 14;
    var b = a * Math.sqrt(l);
    return b;
  }

  var growthFactor = likes(l) + comments(c) + shares(s);

  if (growthFactor <= 40 ) {
    growthFactor = 40;
    return growthFactor;

  } else {
    if (growthFactor >= 140) {
      growthFactor = 140;
      return growthFactor;

    } else {
      return growthFactor;

    }
  }
}


function getNodePosition(){

  /*
  var checkExistNodes = setInterval(function() {
   if ($('.node').css('left')) {
      console.log("Node exists!");
      nodesDoExist = true;   
      clearInterval(checkExistNodes);
   }
  }, 100); // check every 100ms
  */
  if (!localStorage.positions){
      //int object tor storing positions
      saveNodePositions();
      console.log("new postions postion values stored locally");
      console.log(localStorage.positions);
  }
  else{
      console.log("Postions of nodes already stored!");
      repositionNodes();
  }
}

function checkNodesChanges(){
  console.log(' checkNodesChanges');
  $( ".node" )
  .mouseup(function() {
    saveNodePositions();
  })
  .mousedown(function() {
    console.log('down');
  });
  return true;
}

function saveNodePositions(){
  console.log('save nodes positions troll');
  var postionNodes = {};

  $( ".node" ).each(function(index) {
    //get css per node
    var node_id = $(this).children('div').attr('id');
    var pos_left = $(this).css('left');
    var pos_top = $(this).css('top');
    //build opjects 
    postionNodes[node_id] = {
    'left' : pos_left,
    'top'  : pos_top
    };
  }); 
  console.log(postionNodes);
  //store object as sting to local storage
  localStorage.setItem("positions", JSON.stringify(postionNodes));
}

function repositionNodes(){
  
  var postionNodes = JSON.parse(localStorage.positions);
  
  window.setTimeout(function(){

    $.each(postionNodes, function( index, value ) {
      $('#'+index).parent().css("left:"+postionNodes[index]['left']);
      $('#'+index).parent().css("top:"+postionNodes[index]['top']);
    });
    
    console.log(postionNodes);
    alert('timeout');

  }, 2000);
}