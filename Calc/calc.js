document.addEventListener("DOMContentLoaded", function () {
  const display = document.getElementById("display");
  let currentInput = "0";
  let operator = null;
  let previousInput = null;

  function updateDisplay() {
    display.textContent = currentInput;
  }

  function handleNumber(num) {
    if (currentInput === "0" || currentInput === "-0") {
      currentInput = num;
    } else {
      currentInput += num;
    }
    updateDisplay();
  }

  function handleOperator(op) {
    if (previousInput === null) {
      previousInput = currentInput;
      currentInput = "0";
    } else {
      calculate();
    }
    operator = op;
  }

  function calculate() {
    if (previousInput !== null && operator !== null) {
      let result;
      const num1 = parseFloat(previousInput);
      const num2 = parseFloat(currentInput);

      switch (operator) {
        case "+":
          result = num1 + num2;
          break;
        case "-":
          result = num1 - num2;
          break;
        case "*":
          result = num1 * num2;
          break;
        case "/":
          if (num2 === 0) {
            alert("Ділення на нуль неможливе!");
            clearCalculator();
            return;
          }
          result = num1 / num2;
          break;
        default:
          return;
      }

      currentInput = result.toString();
      operator = null;
      previousInput = null;
      updateDisplay();
    }
  }

  function clearCalculator() {
    currentInput = "0";
    previousInput = null;
    operator = null;
    updateDisplay();
  }

  function handleBackspace() {
    if (currentInput.length > 1) {
      currentInput = currentInput.slice(0, -1);
    } else {
      currentInput = "0";
    }
    updateDisplay();
  }

  function handleDecimal() {
    if (!currentInput.includes(".")) {
      currentInput += ".";
    }
    updateDisplay();
  }

  document.querySelectorAll(".number").forEach((button) => {
    button.addEventListener("click", () => handleNumber(button.textContent));
  });

  document.querySelectorAll(".operator").forEach((button) => {
    button.addEventListener("click", () => handleOperator(button.textContent));
  });

  document.querySelector(".equal").addEventListener("click", calculate);
  document.querySelector(".clear").addEventListener("click", clearCalculator);
  document
    .querySelector(".backspace")
    .addEventListener("click", handleBackspace);
  document.querySelector(".decimal").addEventListener("click", handleDecimal);
});
