(() => {
  console.log("test");
  function detectChecked() {
    Array.from(document.getElementsByClassName("checkbox")).forEach(element => {
      element.addEventListener("click", async (e) => {
        if (e.target.checked) {
          console.log(`elem with id  ${e.target.id} checked`);
          const elem = {
              id: e.target.id
          }
        let res = await fetch("index.php", {
             method: "post",
             body: JSON.stringify(elem)
           }).then(function(response){
               return response.text();
           }).then( function(text){
               console.log(text);
           })
           console.log(res);
        } else {
            console.log(`elem with id  ${e.target.id} unchecked`);
        }
      });
    });
  }
  detectChecked();
})();
