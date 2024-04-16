// Add a class to the snake head to apply the snake-head style
snakeHead.classList.add("snake-head");

// Remove the snake-head class from the rest of the snake parts
currentSnake.forEach((index) => {
  cells[index].classList.remove("snake-head");
});

// Add snake parts to the snake
currentSnake.forEach((index) => {
  const snakePart = document.createElement("div");
  snakePart.classList.add("snake-part");
  cells[index].appendChild(snakePart);
});

// Add a snake-head element to the first cell
const snakeHead = document.createElement("div");
snakeHead.classList.add("snake-head");
cells[0].appendChild(snakeHead);

const pacMan = document.getElementById('pac-man');
const dots = document.getElementById('dots');
const gameSize = 400;
const pacManSize = 20;
const dotSize = 5;
const dotCount = 180;
const dotInterval = 200;
const pacManSpeed = 2;

let x = 0;
let y = 0;
let dx = 1;
let dy = 0;
let dotsCount = 0;
let dotsInterval = 0;

const dotsArray = [];

function createDots() {
  for (let i = 0; i < dotCount; i++) {
    const dot = document.createElement('div');
    dot.classList.add('dot');
    dot.style.top = `${Math.floor(Math.random() * (gameSize - dotSize))}px`;
    dot.style.left = `${Math.floor(Math.random() * (gameSize - dotSize))}px`;
    dots.appendChild(dot);
    dotsArray.push(dot);
  }
  dotsInterval = setInterval(drawDots, dotInterval);
}

function drawPacMan() {
  pacMan.style.top = `${y}px`;
  pacMan.style.left = `${x}px`;
}

function drawDots() {
  dotsArray.forEach(dot => {
    dot.style.top = `${parseInt(dot.style.top, 10) + dy}px`;
    dot.style.left = `${parseInt(dot.style.left, 10) + dx}px`;
  });
}

function checkCollisions() {
  dotsArray.forEach(dot => {
    if (
      x < parseInt(dot.style.left, 10) + dotSize &&
      x + pacManSize > parseInt(dot.style.left, 10) &&
      y < parseInt(dot.style.top, 10) + dotSize &&
      y + pacManSize > parseInt(dot.style.top, 10)
    ) {
      dot.remove();
      dotsArray.splice(dotsArray.indexOf(dot), 1);
      dotsCount++;
    }
  });
}

function updateGame() {
  if (dotsCount === dotCount) {
    clearInterval(dotsInterval);
    alert('You ate all the dots!');
  }
  drawPacMan();
  checkCollisions();
}

function movePacMan() {
  if (x + pacManSize > gameSize || x < 0 || y + pacManSize > gameSize || y < 0) {
    alert('Game Over');
    clearInterval(dotsInterval);
  }
  x += dx * pacManSpeed;
  y += dy * pacManSpeed;
  drawPacMan();
  updateGame();
}

createDots();
setInterval(movePacMan, 100);