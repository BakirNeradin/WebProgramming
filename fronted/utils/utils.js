var Utils = {

  init_spapp: () => {
    var app = $.spapp({
      defaultView: "#home",
      templateDir: "./pages/",
    });

    app.route({
      view: "home",
      load: "home.html"
    });
    app.route({
      view: "petition",
      load: "petition.html"
    });
    app.route({
      view: "admindashboard",
      load: "admindashboard.html"
    });
    app.route({
      view: "account",
      load: "account.html"
    });

    $(document);
    app.run();
  },

  parseJwt: function (token) {
    if (!token) return null;
    try {
      const payload = token.split('.')[1];
      const decoded = atob(payload);
      return JSON.parse(decoded);
    } catch (e) {
      console.error("Invalid JWT token", e);
      return null;
    }
  },

  datatable: function (table_id, columns, data, pageLength = 15) {
    if ($.fn.dataTable.isDataTable("#" + table_id)) {
      $("#" + table_id).DataTable().destroy();
    }

    $("#" + table_id).DataTable({
      data: data,
      columns: columns,
      pageLength: pageLength,
      lengthMenu: [2, 5, 10, 15, 25, 50, 100, "All"],
    });
  }

};
