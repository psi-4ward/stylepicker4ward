Mediabox.scanPage = function() {
  var links = $$('a').filter(function(el) {
    return el.rel && el.rel.test(/^lightbox/i);
  });
  var options = {
    'showCaption': false,
    'showCounter': false
  };
  $$(links).mediabox(options, null, function(el) {
    var rel0 = this.rel.replace(/[[]|]/gi,' ');
    var relsize = rel0.split(' ');
    return (this == el) || ((this.rel.length > 8) && el.rel.match(relsize[1]));
  });
};

window.addEvent('domready', Mediabox.scanPage);