//Change the map according to the branch location
const galle = document.getElementById("galle");
const matara = document.getElementById("matara");
const colombo = document.getElementById("colombo");
const jaffna = document.getElementById("jaffna");
const kandy = document.getElementById("kandy");
const anuradhapura = document.getElementById("anuradhapura");
const trincomalee = document.getElementById("trincomalee");
const baticalo = document.getElementById("baticalo");

const map = document.getElementById("map-image");

//when mouse over

galle.onmouseover = function () {
  map.src = "images/branches/galle.png";
};
matara.onmouseover = function () {
  map.src = "images/branches/matara.png";
};
colombo.onmouseover = function () {
  map.src = "images/branches/colombo.png";
};
jaffna.onmouseover = function () {
  map.src = "images/branches/jaffna.png";
};
kandy.onmouseover = function () {
  map.src = "images/branches/kandy.png";
};
anuradhapura.onmouseover = function () {
  map.src = "images/branches/anuradhapura.png";
};
trincomalee.onmouseover = function () {
  map.src = "images/branches/trincomalee.png";
};
baticalo.onmouseover = function () {
  map.src = "images/branches/baticalo.png";
};

//when mouse out

galle.onmouseout = function () {
  map.src = "images/branches/map.png";
};
matara.onmouseout = function () {
  map.src = "images/branches/map.png";
};
colombo.onmouseout = function () {
  map.src = "images/branches/map.png";
};
jaffna.onmouseout = function () {
  map.src = "images/branches/map.png";
};
kandy.onmouseout = function () {
  map.src = "images/branches/map.png";
};
anuradhapura.onmouseout = function () {
  map.src = "images/branches/map.png";
};
trincomalee.onmouseout = function () {
  map.src = "images/branches/map.png";
};
baticalo.onmouseout = function () {
  map.src = "images/branches/map.png";
};
