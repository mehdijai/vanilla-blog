const scrollUpButton = document.getElementById("scroll-up");

document.addEventListener("scroll", () => {
  const docScroll = document.documentElement.scrollTop;
  if (scrollUpButton) {
    if (document.body.scrollTop > 200 || docScroll > 200) {
      scrollUpButton.style.display = "inline-flex";
    } else {
      scrollUpButton.style.display = "none";
    }
  }
});

function scrollUp() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

scrollUpButton.addEventListener("click", scrollUp);
