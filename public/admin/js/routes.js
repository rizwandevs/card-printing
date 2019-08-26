var routes = Backbone.Router.extend({
    routes: {
        "": "dashboard",
        "*notFound": "requestURL"
    },
    dashboard: function(){
        app.callRoute("/home/dashboard");
    },
    requestURL: function(url){
        app.callRoute("/"+url);
    }
});
app.routes = new routes();
Backbone.history.start({
    pushState: true,
    root: app.root
});

$(document).on("click", "a[data-spa]", function(evt) {
    evt.preventDefault();
    var href = $(this).attr("href");
    href = href.substring(href.indexOf(app.root)+app.root.length);
    if(!Backbone.history.navigate(href,true)){
        app.reload();
    }
});