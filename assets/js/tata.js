/*
Template Name: Skote - Admin & Dashboard Template
Author: Themesbrand
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Form Advanced Js File
*/

!function ($) {
    "use strict";

    var AdvancedForm = function () { };

    AdvancedForm.prototype.init = function () {

      $('#TipMagacina').select2({
        ajax: {
          url: "http://138.197.189.75/getgradovi",
          // url: "http://localhost/newstress/gari.php",
        //   url: "https://api.github.com/search/repositories",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              q: params.term, // search term
              page: params.page
            };
          },
          processResults: function (data, params) {
              console.log(data);
            // parse the results into the format expected by Select2
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data, except to indicate that infinite
            // scrolling can be used
            params.page = params.page || 1;
  
            return {
              results: data.items,
              pagination: {
                more: (params.page * 30) < data.total_count
              }
            };
          },
          cache: true
        },
        placeholder: 'Oznaci Grad',
        minimumInputLength: 1,
        templateResult: formatRepo,
        templateSelection: formatRepoSelection
      });

      function formatRepo(repo) {
        console.log(repo);
        if (repo.loading) {
          return repo.text;
        }

        var $container = $(
          "<div class='select2-result-repository clearfix'>" +
          "<div class='select2-result-repository__avatar'>" + repo.full_name + "' </div>" +
          "</div>"
        );
  
        // $container.find(".select2-result-repository__title").text(repo.full_name);
        // $container.find(".select2-result-repository__description").text(repo.description);
        // $container.find(".select2-result-repository__forks").append(repo.forks_count + " Forks");
        // $container.find(".select2-result-repository__stargazers").append(repo.stargazers_count + " Stars");
        // $container.find(".select2-result-repository__watchers").append(repo.watchers_count + " Watchers");
  
        return $container;
      }
  
      function formatRepoSelection(repo) {
        return repo.full_name || repo.text;
      }
    },
      //init
      $.AdvancedForm = new AdvancedForm, $.AdvancedForm.Constructor = AdvancedForm
  }(window.jQuery),
  
    //Datepicker
    function ($) {
      "use strict";
      $.AdvancedForm.init();
    }(window.jQuery);
  