var Authors = function($http){
    this.$http = $http;
}

Authors.prototype.getAuthorsName = function(onsuccess){
    this.$http({
        method: 'POST',
        url: '/authors/search',
    }).then(function(response){
        if (response.data.success){
            onsuccess && onsuccess(response.data.authors);
        }
        else
            throw new Error(response.data.message);
    });
}

app.service('Authors',Authors);