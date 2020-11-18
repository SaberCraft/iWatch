var categoryList = ["الطبخ","البناء","الحرف","فنون"];
 
var jobList = {
    "الطبخ":["أكلات الأعراس","صناعة الحلويات","أكلات تقليدية","حلويات الأعراس"],
    "البناء":["بناء","بلاط","ب","بلدية 8"],
    "الحرف":["رصاص","لحام"],
    "فنون":["رسام","مصمم "],
};
 
 
function fetchCategory(categoryList) {
    var templateCategory = `<option value="----">إختر المجال</option>`;
    categoryList.forEach((element, index) => {
        templateCategory += `<option value="${element}">${element}</option>`
    });
    return templateCategory
}
 
document.getElementById("category").innerHTML = fetchCategory(categoryList);
 
 
 
 
function updateJob(category) {
    var templateJob = '';
    for (var job in jobList) {
        if (job==category) {
            jobList[job].forEach((element, index) => {
                templateJob += `<option value="${element}">${element}</option>`
            })
        }
      }
 
    document.getElementById("job").innerHTML = templateJob;
}
 
 
$('#category').change(function(e){
    var currentCategory = $('#category').val();
    updateJob(currentCategory);
})