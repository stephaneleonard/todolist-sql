const Sortable = window.Sortable;
(() => {
  var el = document.getElementById("todo");
  Sortable.create(el, {
    onEnd: evt => {
      console.log(evt.oldDraggableIndex + 1);
      console.log(evt.newDraggableIndex + 1);
      console.log(evt.item.getElementsByTagName("input")[0].id);
      setNewRanking(
        evt.newDraggableIndex + 1,
        evt.oldDraggableIndex + 1,
        0,
        evt.item.getElementsByTagName("input")[0].id
      );
    }
  });

  function detectChecked($list) {
    document.getElementById($list).addEventListener("click", e => {
      console.log(event.target.tagName);
      if (event.target.tagName == "INPUT") {
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
      }
    });
  }
  detectChecked("todo");
  detectChecked("done");

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
        console.log(text);
        if (text == "error") {
          console.log("Error");
        } else {
          toggleList(e);
        }
      })
      .catch(function(error) {
        console.error(error);
      });
  }

  function toggleList(e) {
    const todo = document.getElementById("todo");
    const done = document.getElementById("done");
    const todoClass = "text-xl block hover:bg-gray";
    const doneClass = "text-xl block line-through text-muted hover:bg-gray";
    const li = e.toElement.parentNode;
    console.log(li);
    const label = li;
    console.log(label);
    li.parentNode.removeChild(li);
    if (e.target.checked) {
      label.className = doneClass;
      done.appendChild(li);
    } else {
      label.className = todoClass;
      label.draggable = true;
      todo.appendChild(li);
    }
  }

  function getForm() {
    const myForm = document.getElementById("myForm");
    myForm.addEventListener("submit", e => {
      e.preventDefault();

      const formData = new FormData(myForm);

      fetch("./controller/ajaxAddController.php", {
        method: "post",
        body: formData
      })
        .then(function(response) {
          return response.json();
        })
        .then(function(json) {
          console.log(json[0]);
          addNewTodo(json[0]);
          myForm.reset();
        })
        .catch(function(error) {
          console.error(error);
        });
    });
  }
  getForm();

  function addNewTodo(e) {
    //create the element
    const todo = document.getElementById("todo");
    const li = document.createElement("li");
    const label = document.createElement("label");
    const input = document.createElement("input");
    //append data
    li.className = "hover:bg-gray";
    li.draggable = "true";
    input.setAttribute("type", "checkbox");
    input.className = "checkbox mr-2 leading-tight";
    input.id = `${e["id"]}`;
    input.name = `checkbox-${e["id"]}`;
    label.className = "text-xl";
    label.setAttribute("for", `${e["id"]}`);
    label.innerHTML = `${e["todo"]}`;
    //append to todo li
    li.appendChild(input);
    li.appendChild(label);
    todo.appendChild(li);
  }

  function setNewRanking(newRank, oldRank, checked, id) {
    console.log(id);
    fetch("./controller/ajaxUpdateController.php", {
      method: "post",
      body: JSON.stringify({ newRank, oldRank, checked, id }),
      headers: {
        "Content-Type": "application/json"
      }
    })
      .then(function(response) {
        return response.text();
      })
      .then(function(text) {
        console.log(text);
        if (text == "error") {
          console.log(text);
        }
      })
      .catch(function(error) {
        console.error(error);
      });
  }
})();
