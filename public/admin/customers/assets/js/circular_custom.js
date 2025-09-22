let circularProgressElements = document.querySelectorAll(".circular-progress");

circularProgressElements.forEach((progressBar) => {
  let valueContainer = progressBar.querySelector(".value-container");

  // Get the progressEndValue from the data attribute
  let progressEndValue = parseInt(progressBar.dataset.progressEnd, 10) || 0;
  valueContainer.textContent = `0%`;

  let progressValue = 0;
  let speed = 0; // Adjust speed as needed

  let progress = setInterval(() => {
    progressValue++;
    valueContainer.textContent = `${progressValue}%`;
    progressBar.style.background = `conic-gradient(
        #4d5bf9 ${progressValue * 3.6}deg,
        #cadcff ${progressValue * 3.6}deg
    )`;
    if (progressValue == progressEndValue) {
      clearInterval(progress);
    }
  }, speed);
});
