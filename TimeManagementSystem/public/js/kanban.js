const draggable = document.querySelectorAll(".drag-item");
const droppable = document.querySelectorAll(".category")

draggable.forEach((item)=>{
    item.addEventListener("dragstart", () =>{
        item.classList.add("is-dragging"); 
    });
    item.addEventListener("dragend", () =>{
        item.classList.remove("is-dragging"); 
    });
});