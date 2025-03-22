var Utils={
    init_spapp: ()=>{
        var app = $.spapp({
            defaultView  : "#home",
            templateDir  : "./pages/",
        });
          
          app.route({
            view : "home",
            load : "home.html",
            onCreate: function() {  },
            onReady: function() {  }
          });
          app.route({
            view : "about",
            load : "about.html",
            onCreate: function() {  },
            onReady: function() {  }
          });
          app.route({
            view : "faq",
            load : "faq.html",
            onCreate: function() {  },
            onReady: function() {  }
          });
          app.route({
            view : "pricing",
            load : "pricing.html",
            onCreate: function() {  },
            onReady: function() {  }
          });
          app.route({
            view : "contact",
            load : "contact.html",
            onCreate: function() {  },
            onReady: function() {  }
          });
          app.route({
            view : "account",
            load : "account.html",
            onCreate: function() {  },
            onReady: function() {  }
          });
          app.route({
            view : "petition",
            load : "petition.html",
            onCreate: function() {  },
            onReady: function() {  }
          });
          app.route({
            view : "admindashboard",
            load : "admindashboard.html",
            onCreate: function() {  },
            onReady: function() {  }
          });
          $(document)
          app.run();
    }
}