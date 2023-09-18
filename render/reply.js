    var x= `
                <textarea class="tarea" cols="35" rows="10" style="background:lightcyan;" placeholder="write your answer here..."></textarea>
                <span style="color:blue">Reply</span>
                     `;
var el=document.createElement('div')
el.innerHTML=x;
let accordions = document.querySelectorAll('.accordion-container .accordion');

var rep=document.querySelector('.accordion-content')
function show() {
    // body...
       for (var i = 0; i < rep.length; i++) {
        var one = rep[i]

         one.append(el)
    }
}
    for (var i = 0; i <accordions.length; i++) {
        var one = accordions[i]
        one.addEventListener('click', show)
            }

            accordions.forEach(acco =>{
    acco.onclick = () =>{
        accordions.forEach(subAcco => { subAcco.classList.remove('active') });
        acco.classList.add('active');
        show();
    }
})
