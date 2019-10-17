var tickCell = function() {
  var active = null, img = "url('images/success_small_s.png')";
  if (this.attachEvent) {
    this.attachEvent('onunload', (active = null))
  }
  return function(element) {
      if ((active != element) && element.style) {
          if (active) active.style.backgroundImage = '';
          element.style.backgroundImage= img;
          active = element;
      }
  };
}();