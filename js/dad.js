var et1 = document.getElementById('AG');
var et2 = document.getElementById('NAG');


new Sortable(et1,{
  group: 'shared',
  Animation: 150,
  dragClass: "dragging",
  ghostClass: 'blue-background-class',
  store:{
    set: (sortable) =>{
        const orden = sortable.toArray();
        agrupacion = orden.join(',');
    }
  }
})

new Sortable(et2,{
  group: 'shared',
  Animation: 150,
  dragClass: "dragging",
  ghostClass: 'blue-background-class'
});


