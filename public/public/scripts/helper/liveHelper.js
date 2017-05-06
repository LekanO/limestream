function apiModifyTable(originalData,id,response){
    angular.forEach(originalData, function (live,key) {
        if(live.id == id){
            originalData[key] = response;
        }
    });
    return originalData;
}
