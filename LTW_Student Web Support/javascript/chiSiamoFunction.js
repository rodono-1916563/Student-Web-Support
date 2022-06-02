
// Per il Flip delle card del team
function cardFlipping() 
{
  var array = document.getElementsByClassName("flip-card-container");
  for (i = 0; i < array.length; i++) {
    element = array[i];
    element.addEventListener("click", function () {
      this.classList.toggle("flip");
    });
  }
}