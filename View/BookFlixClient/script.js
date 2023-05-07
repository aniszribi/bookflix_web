// JS
const img = document.getElementById("img");
const cancel = document.getElementById("cancel");

cancel.addEventListener("click", () => {
  img.style.display = "none";
});

setInterval(() => {
    img.style.display = "block";
  }, 20000);