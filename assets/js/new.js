

let previous = document.querySelector('#previous')
let next = document.querySelector('#next')
let lessons = document.querySelectorAll('.lesson')
let idKey = 0



previous.onclick = function(){
    idKey--
    displayLesson (idKey)
    // $(lesson).text("{{ render(controller('App\\\\Controller\\\\LessonController::index',{idLesson: listId[" + idKey + "]})) }}");
}

next.onclick = function(){
    idKey++
    displayLesson (idKey)

    // $(lesson).attr("{{ render(controller('App\\\\Controller\\\\LessonController::index',{idLesson: listId[" + idKey + "]})) }}");
}

const displayLesson = (idKey) => {
    lessons.forEach(lesson => {
        console.log(lessonNbr)
        console.log(idKey)
        lesson.classList.add("d-none")
        if (idKey == lesson.id) {
            lesson.classList.remove("d-none")
        }
        if (idKey ==0) {
            previous.classList.add("disabled")
            next.classList.remove("disabled")
        }
        else if (idKey == lessonNbr-1) {
            next.classList.add("disabled")
            previous.classList.remove("disabled")

        } else {
            next.classList.remove("disabled")
            previous.classList.remove("disabled")
        }
    })
}



//
// let idKeys = document.getElementById('idKeys');
// console.log (idKeys);
// console.log (idKeys[0]);
//
//
// // {{ render(path('app_lesson', {idLesson: listId[0]}))}}
//
//



// var idKey = 1;
//
// affichId()
//
// function idKeysIncrement(){
//     idKey-=1;
//     console(idKey)
// }
//
//
//
//

// $('previous').on("click", () => idKeysDecrement());
// $('next').on("click", () => idKeysIncrement());

