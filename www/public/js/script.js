(() => {
  console.log("test");
  function detectChecked() {
    Array.from(document.getElementsByClassName("checkbox")).forEach(element => {
      element.addEventListener("click", e => {
        if (e.target.checked) {
          console.log(`elem with id  ${e.target.id} checked`);
          const elem = {
            id: e.target.id,
            checked: 1
          };
          fetchData(elem, e);
        } else {
          console.log(`elem with id  ${e.target.id} unchecked`);
          const elem = {
            id: e.target.id,
            checked: 0
          };
          fetchData(elem, e);
        }
      });
    });
  }
  detectChecked();

  function fetchData(elem, e) {
    fetch("./controller/ajaxController.php", {
      method: "post",
      body: JSON.stringify(elem),
      headers: {
        "Content-Type": "application/json"
      }
    })
      .then(function(response) {
        return response.text();
      })
      .then(function(text) {
        console.log(text)
        if (text == "error") {
          console.log("Error");
        } else {
          toggleList(e);
        }
      });
  }

  function toggleList(e) {
    const todo = document.getElementById("todo");
    const done = document.getElementById("done");
    const todoClass = "text-xl block hover:bg-gray";
    const doneClass = "text-xl block line-through text-muted hover:bg-gray";
    const li = e.toElement.parentNode.parentElement;
    const label = e.toElement.parentNode;
    li.parentNode.removeChild(li);
    if (e.target.checked) {
      label.className = doneClass;
      done.appendChild(li);
    } else {
      label.className = todoClass;
      todo.appendChild(li);
    }
  }
})();
