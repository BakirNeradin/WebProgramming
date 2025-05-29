

var UserService = {
 init: function () {
   var token = localStorage.getItem("user_token");
   if (token && token !== undefined) {
     window.location.replace("index.html");
   }
   $("#login-form").validate({
     submitHandler: function (form) {
       var entity = Object.fromEntries(new FormData(form).entries());
       UserService.login(entity);
     },
   });
 },
 login: function (entity) {
   $.ajax({
     url: Constants.PROJECT_BASE_URL + "auth/login",
     type: "POST",
     data: JSON.stringify(entity),
     contentType: "application/json",
     dataType: "json",
     success: function (result) {
       console.log(result);
       localStorage.setItem("user_token", result.data.token);
       window.location.replace("index.html");
     },
     error: function (XMLHttpRequest, textStatus, errorThrown) {
       toastr.error(XMLHttpRequest?.responseText ?  XMLHttpRequest.responseText : 'Error');
     },
   });
 },


 logout: function () {
   localStorage.clear();
   window.location.replace("account.html");
 },
 generateMenuItems: function(){
   const token = localStorage.getItem("user_token");
   const user = Utils.parseJwt(token);


   if (user && user.role){
     let nav = "";
     let main = "";
     switch(user.role) {
       case Constants.ADMIN_ROLE:
         nav =   `           <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                            <li class="nav-item"><a class="nav-link" href="#pricing">Support</a></li>
                            <li class="nav-item"><a class="nav-link" href="#faq">FAQ</a></li>
                            <li class="nav-item"><a class="nav-link" href="#account">Account</a></li>
                            <li class="nav-item"><a class="nav-link" href="#petition">Petition</a></li>
                            <li class="nav-item"><a class="nav-link" href="#admindashboard">Admin Dashboard</a></li>`;
             $("#menuTabs").html(nav);
         main =
             `<section id="home" data-load="home.html"></section>
            <section id="about" data-load="about.html"></section>
            <section id="contact" data-load="contact.html"></section>
            <section id="pricing" data-load="pricing.html"></section>
            <section id="faq" data-load="faq.html"></section>
            <section id="account" data-load="account.html"></section>
            <section id="petition" data-load="petition.html"></section>
            <section id="admindashboard" data-load="admin.html"></section>`;
             $("#spapp").html(main);
         break;
       case Constants.USER_ROLE:
         nav =  `           <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                            <li class="nav-item"><a class="nav-link" href="#pricing">Support</a></li>
                            <li class="nav-item"><a class="nav-link" href="#faq">FAQ</a></li>
                            <li class="nav-item"><a class="nav-link" href="#account">Account</a></li>
                            <li class="nav-item"><a class="nav-link" href="#petition">Petition</a></li>`;
             $("#menuTabs").html(nav);
         main =
             `<section id="home" data-load="home.html"></section>
            <section id="about" data-load="about.html"></section>
            <section id="contact" data-load="contact.html"></section>
            <section id="pricing" data-load="pricing.html"></section>
            <section id="faq" data-load="faq.html"></section>
            <section id="account" data-load="account.html"></section>
            <section id="petition" data-load="petition.html"></section>`;
             $("#spapp").html(main);
         break;
       default:
         $("#menuTabs").html(nav);
         $("#spapp").html(main);
     }
   } else {
      window.location.replace("index.html");
   }
 }
};
