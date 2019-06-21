jQuery( () => {
  var scrollTopButton = document.querySelector( '.header-side-cta-bubble' );
  scrollTopButton &&
    scrollTopButton.addEventListener( 'click', () => anime({
      targets: "html, body",
      duration: 1200,
      easing: 'linear',
      scrollTop: -window.pageYOffset
    }) );
} );
