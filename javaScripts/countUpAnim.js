function animateCount(element) {
  const target = parseInt(element.getAttribute("data-count"));
  let current = 0;
  const duration = 2000;
  const steps = 100;
  const stepTime = duration / steps;
  const increment = target / steps;
  let step = 0;

  const updateCount = () => {
    if (current < target) {
      current += increment;
      step++;
      if (current > target) current = target;
      element.innerText = Math.floor(current);
      if (step < steps) {
        const remainingSteps = steps - step;
        const slowdownFactor = Math.pow(remainingSteps / steps, 2);
        setTimeout(updateCount, stepTime * slowdownFactor);
      }
    }
  };

  updateCount();
}

function handleCountAnimation() {
  const countElements = document.querySelectorAll(".countText h1");
  countElements.forEach((element) => {
    if (isElementInViewport(element)) {
      animateCount(element);
    }
  });
}

function isElementInViewport(element) {
  const rect = element.getBoundingClientRect();
  return (
    rect.top >= 0 &&
    rect.left >= 0 &&
    rect.bottom <=
      (window.innerHeight || document.documentElement.clientHeight) &&
    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
  );
}

document.addEventListener("scroll", handleCountAnimation);

handleCountAnimation();
