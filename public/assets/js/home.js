// default homepage js file

// pure JS functions
window.onload = function() {

  var trigger = new Trigger();
  trigger.findTrigger();

  window.onscroll = function() {
    fixedHeader()
  };

  function fixedHeader() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
      document.getElementById("scroll").classList.add("fix");
    } else {
      document.getElementById("scroll").classList.remove("fix");
    }
  }
};
