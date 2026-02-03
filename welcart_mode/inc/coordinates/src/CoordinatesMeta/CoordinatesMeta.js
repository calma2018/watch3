var coordinates = {
  skus: [],
  skuIndex: 0,
  itemName: "",
  routeSettings: {
    type: "GET",
    cache: false,
    beforeSend: function (xhr) {
      xhr.setRequestHeader("X-WP-Nonce", mode.nonce);
    },
  },
  selectcat: function (cat_id) {
    if (cat_id == "-1") {
      $("#coordinates-itemcode").html("");
      return false;
    }
    jQuery("#loading").html(mode.loader);
    var s = coordinates.routeSettings;
    s.url = mode.endpoint + "mode/getItemsByCategoryId";
    s.data = "catId=" + cat_id;
    s.success = function (data) {
      jQuery("#loading").html("");
      jQuery("#coordinates-itemcode").html(data);
    };
    jQuery.ajax(s);
    return false;
  },
  getitem: function (itemcode) {
    if (itemcode == "-1") {
      jQuery("#newitemform").html("");
      return false;
    }
    jQuery("#loading").html(mode.loader);
    var s = coordinates.routeSettings;
    s.url = mode.endpoint + "mode/getItemDataByItemCode";
    s.data = "itemCode=" + itemcode;
    s.success = function (response) {
      coordinates.skus = response.skus;
      coordinates.itemName = response.itemName;
      coordinates.skuIndex = 0;
      jQuery("#loading").html("");
      jQuery("#itemdetails").remove();
      jQuery("#coordinates-t-bottom").after(response.html);
    };
    s.error = function (msg) {
      jQuery("#loading").html("");
      jQuery("#itemdetails").remove();
      jQuery("#coordinates-api-response").html(msg);
    };
    jQuery.ajax(s);
    return false;
  },
  addtab: function () {
    var selectedMetaId = Number(coordinates.skus[coordinates.skuIndex].meta_id);
    var exists = false;
    jQuery("input[name='coordinates-meta-ids[]']").each(function () {
      var id = jQuery(this).val();
      if (selectedMetaId === Number(id)) {
        exists = true;
        return false;
      }
    });

    if (exists === true) {
      return;
    }

    var skuName = coordinates.skus[coordinates.skuIndex].name;
    if (!skuName) {
      skuName = coordinates.skus[coordinates.skuIndex].code;
    }
    var tabImage = coordinates.skus[coordinates.skuIndex].tabImage;
    var tab = '<li class="ui-state-default">';
    tab +=
      '<input type="hidden" name="coordinates-meta-ids[]" value="' +
      selectedMetaId +
      '" />';
    tab += '<div class="li-wrapper">';
    tab += tabImage;
    tab += '<div class="li-item-name">';
    tab += "<span>" + coordinates.itemName + "　" + skuName + "</span>";
    tab += '<div class="li-delete">';
    tab += '<span class="dashicons dashicons-dismiss"></span>';
    tab += "</div>";
    tab += "</div>";
    tab += "</div>";
    tab += "</li>";
    jQuery("#item-tabs").append(tab);
  },
};

jQuery(document).on("change", "#coordinates-itemcode", function () {
  coordinates.getitem(jQuery(this).val());
});

jQuery(document).on("change", "#coordinates-category", function () {
  coordinates.selectcat(jQuery(this).val());
});

jQuery(document).on("change", "#coordinates-sku-select", function () {
  var index = jQuery(this).val();
  coordinates.skuIndex = index;
  jQuery("#coordinates-sku-code").html(coordinates.skus[index].code);
  jQuery("#coordinates-sku-name").html(coordinates.skus[index].name);
});

jQuery(document).on("click", ".li-delete", function () {
  jQuery(this).closest("li").remove();
});

jQuery(document).on("click", "#coordinates-add-sku-button", function () {
  coordinates.addtab();
});

jQuery(document).on("click", "#coordinates-getitembtn", function () {
  if (jQuery("#coordinates-itemcodein").val() == "") {
    return;
  }

  coordinates.getitem(encodeURIComponent(jQuery("#coordinates-itemcodein").val()));
});

jQuery(document).ready(function () {
  jQuery("#item-tabs").sortable({
    connectWith: "#item-tabs",
  });
  jQuery("#item-tabs").disableSelection();
});
