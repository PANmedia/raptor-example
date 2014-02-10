var myIframe = document.getElementsByTagName('iframe')[0];

var MutationObserver = window.MutationObserver || window.WebKitMutationObserver;

myIframe.addEventListener('load', function() {
  setIframeHeight();

  var target = myIframe.contentDocument.body;

  var observer = new MutationObserver(function(mutations) {
    setIframeHeight();
  });

  var config = {
    attributes: true,
    childList: true,
    characterData: true,
    subtree: true
  };
  observer.observe(target, config);
});

function setIframeHeight() {
  myIframe.style.height = 'auto';
  myIframe.style.height = myIframe.contentDocument.body.offsetHeight + 50 + 'px';
}
