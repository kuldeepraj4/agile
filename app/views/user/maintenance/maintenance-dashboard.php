<style type="text/css">
  table, th, td {
  border: 1px solid #ddd;
  border-collapse: collapse;
}
.lightblue{
  background-color:#cdf4fa;
}
.darkblue{
  background-color:#486e94;
  color:white;
  text-decoration: none;
}
.checkbox-button{
  display: flex; 
  vertical-align: top;
  /* margin-top:10px; */
  }
  .checkbox-button-color{
  padding:5px 14px;
   margin-left:5px;
    border-radius: 3px;
 }
 select[data-multi-select-plugin] {
    display: none !important;
}

.multi-select-component {
    position: relative;
    /*display: flex;
*/    flex-direction: row;
    flex-wrap: wrap;
    height: auto;
    width: 136%;
    padding: 3px 8px;
    font-size: 14px;
    line-height: 1.42857143;
    padding-bottom: 0px;
    color: #555;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    -webkit-transition: border-color ease-in-out 0.15s, -webkit-box-shadow ease-in-out 0.15s;
    -o-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
    transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
}
.autocomplete-list {
    border-radius: 4px 0px 0px 4px;
}

.multi-select-component:focus-within {
    box-shadow: inset 0px 0px 0px 2px #78ABFE;
}

.multi-select-component .btn-group {
    display: none !important;
}

.multiselect-native-select .multiselect-container {
    width: 100%;
}

.selected-wrapper {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    display: inline-block;
    border: 1px solid #d9d9d9;
    background-color: #ededed;
    white-space: nowrap;
    margin: 1px 5px 5px 0;
    height: 22px;
    vertical-align: top;
    cursor: default;
}

.selected-wrapper .selected-label {
    max-width: 514px;
    display: inline-block;
    overflow: hidden;
    text-overflow: ellipsis;
    padding-left: 4px;
    vertical-align: top;
}

.selected-wrapper .selected-close {
    display: inline-block;
    text-decoration: none;
    font-size: 14px;
    line-height: 1.49em;
    margin-left: 5px;
    padding-bottom: 10px;
    height: 100%;
    vertical-align: top;
    padding-right: 4px;
    opacity: 0.2;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    font-weight: 700;
}

.search-container {
    display: flex;
    flex-direction: row;
}

.search-container .selected-input {
    background: none;
    border: 0;
    height: 20px;
    width: 60px;
    padding: 0;
    margin-bottom: 6px;
    -webkit-box-shadow: none;
    box-shadow: none;
}

.search-container .selected-input:focus {
    outline: none;
}

.dropdown-icon.active {
    transform: rotateX(180deg)
}

.search-container .dropdown-icon {
    display: inline-block;
    padding: 10px 5px;
    position: absolute;
    top: 5px;
    right: 5px;
    width: 10px;
    height: 10px;
    border: 0 !important;
    /* needed */
    -webkit-appearance: none;
    -moz-appearance: none;
    /* SVG background image */
    background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2212%22%20height%3D%2212%22%20viewBox%3D%220%200%2012%2012%22%3E%3Ctitle%3Edown-arrow%3C%2Ftitle%3E%3Cg%20fill%3D%22%23818181%22%3E%3Cpath%20d%3D%22M10.293%2C3.293%2C6%2C7.586%2C1.707%2C3.293A1%2C1%2C0%2C0%2C0%2C.293%2C4.707l5%2C5a1%2C1%2C0%2C0%2C0%2C1.414%2C0l5-5a1%2C1%2C0%2C1%2C0-1.414-1.414Z%22%20fill%3D%22%23818181%22%3E%3C%2Fpath%3E%3C%2Fg%3E%3C%2Fsvg%3E");
    background-position: center;
    background-size: 10px;
    background-repeat: no-repeat;
}

.search-container ul {
    position: absolute;
    list-style: none;
    padding: 0;
    z-index: 3;
    margin-top: 29px;
    width: 100%;
    right: 0px;
    background: #fff;
    border: 1px solid #ccc;
    border-top: none;
    border-bottom: none;
    -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
    box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
}

.search-container ul :focus {
    outline: none;
}

.search-container ul li {
    display: block;
    text-align: left;
    padding: 8px 29px 2px 12px;
    border-bottom: 1px solid #ccc;
    font-size: 14px;
    min-height: 31px;
}

.search-container ul li:first-child {
    border-top: 1px solid #ccc;
    border-radius: 4px 0px 0 0;
}

.search-container ul li:last-child {
    border-radius: 4px 0px 0 0;
}


.search-container ul li:hover.not-cursor {
    cursor: default;
}

.search-container ul li:hover {
    color: #333;
    background-color: rgb(251, 242, 152);
    ;
    border-color: #adadad;
    cursor: pointer;
}

/* Adding scrool to select options */
.autocomplete-list {
    max-height: 130px;
    overflow-y: auto;
}
</style>
<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br><br>
<section class="list-200 content-box" style="margin: auto;">
  <h1 class="list-200-heading">Dashboard - Schedule/Unschedule</h1>
  <section class="list-200-top-section">
    <div>
    </div>
    <div>
    </div>
  </section>
  <section class="list-200-top-action">
    <div class="list-200-top-action-left">
      <!-- input used for sory by call-->
     <!-- input used for sory by call-->
    <input type="hidden" id="sort_by" value="">
    <!-- //input used for sory by call-->
     <input type='hidden' id='sort' value='asc'>
      <!-- //input used for sort by call-->
      <div class="filter-item">
        <label>Unit Type</label>
        <!-- SEt params FOR URL BY swaran -->
        <!-- <select data-filter="unit_type_id" onchange="set_params('unit_type_id', this.value),set_params('unit_id', ''), goto_page(1), show_unit_filter({unit_type_id:this.value})"></select>-->
        <select data-filter="unit_type_id" onchange="$(`[data-vehicle-id]`).val(''),set_params('unit_type_id', this.value),set_params('vehicle_code', ''),set_params('unit_id', ''), show_unit_filter({unit_type_id:this.value})"></select>
      </div>
      <div class="filter-item">
        <label>Unit ID</label>
        <!-- <select data-filter="unit_id" onchange="set_params('unit_id', this.value), goto_page(1)">
        </select> -->
        <input type="text" data-filter="unit_id" list="quick_list_vehicle_id" data-vehicle-id>
      </div>
      <!-- <div class="filter-item">
        <label>Job Work</label>
        <select data-filter="job_work_id" onchange="set_params('job_work_id', this.value), goto_page(1)">
        </select>
      </div> -->
      <div class="filter-item">
        <label>Followup From Date</label>
        <input type="text" data-filter="followup_date" data-date-picker onchange="set_params('followup_date', this.value)">
        </input>
      </div>

      <div class="filter-item">
        <label>Followup To Date</label>
        <input type="text" data-filter="followup_end_date" data-date-picker onchange="set_params('followup_end_date', this.value)">
        </input>
      </div>


      <div class="filter-item">
        <label>Followup Added By</label>
        <!-- <input type="text" onchange="set_params('followup_by', this.value), goto_page(1)"> -->
        <select data-filter="followup_by" onchange="set_params('followup_by', this.value)">
        </select>
      </div>
      <div class="filter-item" style="width:100%;">
        <label>Stage</label>
        <select multiple data-multi-select-plugin data-filter="stage_id"></select>
        <!-- <span style="color:green; padding-left: 10px; cursor: pointer; font-size: 20px;" >
          <i class="fa fa-search search_stage_filter" ></i>
        </span> -->
      </div>
      
      <div class="checkbox-button">
        <label style="width: 40%; padding: 5px 8px; background: #f1f1f1;">Criticality</label>
          <div class="checkbox-button-color "  style=" background: #ffcce0;">
          <input type="checkbox" id="HIGH" name="HIGH" value="HIGH" data-status-id-group checked>
            <label for="HIGH"> HIGH -<span id="highcount"></label>
        </div>
        <div class="checkbox-button-color" style="background: #fff0b3;">
          <input type="checkbox" id="MEDIUM" name="MEDIUM" value="MEDIUM" data-status-id-group checked>
          <label for="MEDIUM" > MEDIUM - <span id="mediumcount"></label>
            </div>
            <div class="checkbox-button-color" style="background: #dddddd;">
          <input type="checkbox" id="LOW" name="LOW" value="LOW" data-status-id-group>
          <label for="LOW"> LOW - <span id="lowcount"></span></label>
          </div>
        </div>

      <div class="filter-item">
        <label>TAT (Turn Around Time)</label>
        Min: <input data-filter="min_tat" type="number" style="width: 107px" onchange="set_params('min_tat', this.value)" onkeypress="return isNumber(event)" >
        Max: <input data-filter="max_tat" type="number" style="width: 107px" onchange="set_params('max_tat', this.value)" onkeypress="return isNumber(event)" >
      </div>
     
      <div class="filter-item" style="width: 10%!important;margin-top: 10px;">
          <button class="search_stage_filter form-submit-btn">Search</button>
      </div>

    </div>
    <div class="list-200-top-action-right">
      <div>
        <?php if (in_array('P0399', USER_PRIV)) {
          echo "<button class='btn_grey button_href'><a onclick='update_records_for_view()'>Update Schedule/Unschedule</a></button>";
        } ?>
      </div>
    </div>
  </section>
  <div class="table  table-a">
    <input type='hidden' id='sort' value='asc'>
    <table data-ro-table style="font-size: 12px;">
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th data-table-sort-by="unit_no">Unit No</th>
          <th>Location</th>
          <th data-table-sort-by="sc_repairorder_id">RO No - Schedule</th>
          <th data-table-sort-by="sc_repairorder_date">Date Created</th>
          <!-- <th data-table-sort-by="sc_tat">TAT - Turn Around Time</th> -->
          <th>Stage</th>
          <th>Vendor <br/>City, <br/>State</th>
          <th>Type</th>
          <th>Criticality Level</th>
          <th>Job Work</th>
          <th style="min-width:250px; padding:0px 0px; margin: 0px 0px;">Last Note</th>
          <th data-table-sort-by="sc_next_followup">Followup Date</th>
          <th>Followup</th>
          <th>Followup Added By</th>
          <th>Gen WO</th>
          <th data-table-sort-by="un_repairorder_id">RO No - Unschedule</th>
          <th data-table-sort-by="un_repairorder_date">Date Created</th>
          <th data-table-sort-by="un_tat">TAT - Turn Around Time</th>
          <th>Stage</th>
          <th>Vendor <br/>City, <br/>State</th>
          <th>Type</th>
          <th>Criticality Level</th>
          <th>Issue Reported</th>
          <th style="min-width:250px; padding:0px 0px; margin: 0px 0px;">Last Note</th>
          <th data-table-sort-by="un_next_followup">Followup Date</th>
          <th>Followup</th>
          <th>Followup Added By</th>
          <th>Gen WO</th>
        </tr>
      </thead>
      <tbody id="tabledata"></tbody>
    </table>
    </div>
<div data-pagination></div>
</section>
<!-- get param without function start here by swaran -->
<script type="text/javascript">
  var url_params = get_params();
  if (url_params.hasOwnProperty('batch')) {} else {
    set_params('batch', '500')
  }
  if (url_params.hasOwnProperty('followup_date')) {
    $("[data-filter='followup_date']").val(url_params.followup_date);
  }
  if (url_params.hasOwnProperty('followup_end_date')) {
    $("[data-filter='followup_end_date']").val(url_params.followup_end_date);
  }
  if (url_params.hasOwnProperty('min_tat')) {
    $("[data-filter='min_tat']").val(url_params.min_tat);
  }
  if (url_params.hasOwnProperty('max_tat')) {
    $("[data-filter='max_tat']").val(url_params.max_tat);
  }
  if (url_params.hasOwnProperty('unit_id')) {
    $("[data-filter='unit_id']").val(url_params.unit_id);
  }
</script>

<script type="text/javascript">
  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>

<script>
  $(document.body).on('change', "[data-filter='min_tat']", function() {
    var min = $("[data-filter='min_tat']").val();
    var max = $("[data-filter='max_tat']").val();
    if(parseInt(min) > parseInt(max)){
      alert('Min TAT should be less than Max TAT');
      $("[data-filter='min_tat']").val('');
      set_params('min_tat', '');
    }    
  });

  $(document.body).on('change', "[data-filter='max_tat']", function() {
    var min = $("[data-filter='min_tat']").val();
    var max = $("[data-filter='max_tat']").val();
    if(parseInt(min) > parseInt(max)){
      alert('Max TAT should be more than Min TAT');
      $("[data-filter='max_tat']").val('');
      set_params('max_tat', '');
    }    
  });
</script>

<script>
  $(document.body).on('change', "[data-filter='followup_date']", function() {
    var g1 = new Date(check_url_params('followup_date'))
    var g2 = new Date(check_url_params('followup_end_date'))
    if (g1.getTime() > g2.getTime()) {
      alert("Followup From Date should be less than from Followup To Date")
      $("[data-filter='followup_date']").val("").focus();
      set_params('followup_date', '');
    }
  });

  $(document.body).on('change', "[data-filter='followup_end_date']", function() {
    var g1 = new Date(check_url_params('followup_date'))
    var g2 = new Date(check_url_params('followup_end_date'))
    if (g1.getTime() > g2.getTime()) {
      alert("Followup From Date should be greater than from Followup To Date")
      $("[data-filter='followup_end_date']").val("").focus();
      set_params('followup_end_date', '');
    }
  });
</script>


<script type="text/javascript">
  function added_by() {
    quick_list_users({sort_by: 'name', sort_by_order_type: 'asc'}).then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[data-filter="followup_by"]').html(options);
          if (url_params.hasOwnProperty('followup_by')) {
            $("[data-filter='followup_by'] option[value=" + url_params.followup_by + "]").prop('selected', true);
          }
          else{
            set_params('followup_by', '');
          }
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  added_by()
</script>
<script type="text/javascript">
  
  // Initialize function, create initial tokens with itens that are already selected by the user
function init(element) {
    // Create div that wroaps all the elements inside (select, elements selected, search div) to put select inside
    const wrapper = document.createElement("div");
    wrapper.addEventListener("click", clickOnWrapper);
    wrapper.classList.add("multi-select-component");

    // Create elements of search
    const search_div = document.createElement("div");
    search_div.classList.add("search-container");
    const input = document.createElement("input");
    input.classList.add("selected-input");
    input.setAttribute("autocomplete", "off");
    input.setAttribute("tabindex", "0");
    input.addEventListener("keyup", inputChange);
    input.addEventListener("keydown", deletePressed);
    input.addEventListener("click", openOptions);

    const dropdown_icon = document.createElement("span");
    dropdown_icon.setAttribute("href", "close");
    dropdown_icon.classList.add("dropdown-icon");

    dropdown_icon.addEventListener("click", clickDropdown);
    const autocomplete_list = document.createElement("ul");
    autocomplete_list.classList.add("autocomplete-list")
    search_div.appendChild(input);
    search_div.appendChild(autocomplete_list);
    search_div.appendChild(dropdown_icon);

    // set the wrapper as child (instead of the element)
    element.parentNode.replaceChild(wrapper, element);
    // set element as child of wrapper
    wrapper.appendChild(element);
    wrapper.appendChild(search_div);

    createInitialTokens(element);
    addPlaceholder(wrapper);

}

function removePlaceholder(wrapper) {
    const input_search = wrapper.querySelector(".selected-input");
    input_search.removeAttribute("placeholder");
}

function addPlaceholder(wrapper) {
    const input_search = wrapper.querySelector(".selected-input");
    const tokens = wrapper.querySelectorAll(".selected-wrapper");
    if (!tokens.length && !(document.activeElement === input_search))
        input_search.setAttribute("placeholder", "Select options");
}


// Function that create the initial set of tokens with the options selected by the users
function createInitialTokens(select) {
    let {
        options_selected
    } = getOptions(select);
    const wrapper = select.parentNode;
    for (let i = 0; i < options_selected.length; i++) {
        createToken(wrapper, options_selected[i]);
    }


}


// Listener of user search
function inputChange(e) {
    const wrapper = e.target.parentNode.parentNode;
    const select = wrapper.querySelector("select");
    const dropdown = wrapper.querySelector(".dropdown-icon");

    const input_val = e.target.value;

    if (input_val) {
        dropdown.classList.add("active");
        populateAutocompleteList(select, input_val.trim());
    } else {
        dropdown.classList.remove("active");
        const event = new Event('click');
        dropdown.dispatchEvent(event);
    }
}


// Listen for clicks on the wrapper, if click happens focus on the input
function clickOnWrapper(e) {
    const wrapper = e.target;
    if (wrapper.tagName == "DIV") {
        const input_search = wrapper.querySelector(".selected-input");
        const dropdown = wrapper.querySelector(".dropdown-icon");
        if (!dropdown.classList.contains("active")) {
            const event = new Event('click');
            dropdown.dispatchEvent(event);
        }
        input_search.focus();
        removePlaceholder(wrapper);
    }

}

function openOptions(e) {
    const input_search = e.target;
    const wrapper = input_search.parentElement.parentElement;
    const dropdown = wrapper.querySelector(".dropdown-icon");
    if (!dropdown.classList.contains("active")) {
        const event = new Event('click');
        dropdown.dispatchEvent(event);
    }
    e.stopPropagation();

}

// Function that create a token inside of a wrapper with the given value
function createToken(wrapper, value) {

    const search = wrapper.querySelector(".search-container");
    // Create token wrapper
    const token = document.createElement("div");
    token.classList.add("selected-wrapper");
    const token_span = document.createElement("span");
    token_span.classList.add("selected-label");
    token_span.innerText = value;
    const close = document.createElement("span");
    close.classList.add("selected-close");
    close.setAttribute("tabindex", "-1");
    close.setAttribute("data-option", value);
    close.setAttribute("data-hits", 0);
    close.setAttribute("href", "close");
    close.innerText = "x";
    close.addEventListener("click", removeToken)
    token.appendChild(token_span);
    token.appendChild(close);
    wrapper.insertBefore(token, search);

}


// Listen for clicks in the dropdown option
function clickDropdown(e) {

    const dropdown = e.target;
    const wrapper = dropdown.parentNode.parentNode;
    const input_search = wrapper.querySelector(".selected-input");
    const select = wrapper.querySelector("select");
    dropdown.classList.toggle("active");

    if (dropdown.classList.contains("active")) {
        removePlaceholder(wrapper);
        input_search.focus();

        if (!input_search.value) {
            populateAutocompleteList(select, "", true);
        } else {
            populateAutocompleteList(select, input_search.value);

        }
    } else {
        clearAutocompleteList(select);
        addPlaceholder(wrapper);
    }
    
}


// Clears the results of the autocomplete list
function clearAutocompleteList(select) {
    const wrapper = select.parentNode;

    const autocomplete_list = wrapper.querySelector(".autocomplete-list");
    autocomplete_list.innerHTML = "";
}

// Populate the autocomplete list following a given query from the user
function populateAutocompleteList(select, query, dropdown = false) {
    const {
        autocomplete_options
    } = getOptions(select);


    let options_to_show;

    if (dropdown)
        options_to_show = autocomplete_options;
    else
        options_to_show = autocomplete(query, autocomplete_options);

    const wrapper = select.parentNode;
    const input_search = wrapper.querySelector(".search-container");
    const autocomplete_list = wrapper.querySelector(".autocomplete-list");
    autocomplete_list.innerHTML = "";
    const result_size = options_to_show.length;

    if (result_size == 1) {

        const li = document.createElement("li");
        li.classList.add("selected-input-li");
        li.innerText = options_to_show[0];
        li.setAttribute('data-value', options_to_show[0]);
        li.addEventListener("click", selectOption);
        autocomplete_list.appendChild(li);
        if (query.length == options_to_show[0].length) {
            const event = new Event('click');
            li.dispatchEvent(event);

        }
    } else if (result_size > 1) {

        for (let i = 0; i < result_size; i++) {
            const li = document.createElement("li");
             li.classList.add("selected-input-li");
            li.innerText = options_to_show[i];
            li.setAttribute('data-value', options_to_show[i]);
            li.addEventListener("click", selectOption);
            autocomplete_list.appendChild(li);
        }
    } else {
        const li = document.createElement("li");

        li.classList.add("not-cursor");
        li.innerText = "No options found";
        autocomplete_list.appendChild(li);
    }
}


// Listener to autocomplete results when clicked set the selected property in the select option 
function selectOption(e) {
    const wrapper = e.target.parentNode.parentNode.parentNode;
    const input_search = wrapper.querySelector(".selected-input");
    const option = wrapper.querySelector(`select option[value="${e.target.dataset.value}"]`);

    option.setAttribute("selected", "");
    createToken(wrapper, e.target.dataset.value);
    if (input_search.value) {
        input_search.value = "";
    }

    input_search.focus();

    e.target.remove();
    const autocomplete_list = wrapper.querySelector(".autocomplete-list");


    if (!autocomplete_list.children.length) {
        const li = document.createElement("li");
        li.classList.add("not-cursor");
        li.innerText = "No options found";
        autocomplete_list.appendChild(li);
    }

    const event = new Event('keyup');
    input_search.dispatchEvent(event);
    e.stopPropagation();
}


// function that returns a list with the autcomplete list of matches
function autocomplete(query, options) {
    // No query passed, just return entire list
    if (!query) {
        return options;
    }
    let options_return = [];

    for (let i = 0; i < options.length; i++) {
        if (query.toLowerCase() === options[i].slice(0, query.length).toLowerCase()) {
            options_return.push(options[i]);
           // newoptioncheck(options[i]);

        }
    }
    return options_return;
}


// Returns the options that are selected by the user and the ones that are not
function getOptions(select) {


    // Select all the options available
    const all_options = Array.from(
        select.querySelectorAll("option")
    ).map(el => el.value);

    // Get the options that are selected from the user
    const options_selected = Array.from(
        select.querySelectorAll("option:checked")
    ).map(el => el.value);

    const options_selected_id = Array.from(
        select.querySelectorAll("option:checked")
    ).map(el => parseInt(el.getAttribute('id')));
    
    
    
    // $('option:checked').each(function(index, item) {
     //  options_selected.push(item);
       newoptioncheck(options_selected_id);
     // })
    // Create an autocomplete options array with the options that are not selected by the user
    const autocomplete_options = [];

    all_options.forEach(option => {
        if (!options_selected.includes(option)) {
            autocomplete_options.push(option);
        }

    });

    autocomplete_options.sort();

    return {

        options_selected,
        autocomplete_options
    };

}

// Listener for when the user wants to remove a given token.
function removeToken(e) {
    // Get the value to remove
    const value_to_remove = e.target.dataset.option;
    const wrapper = e.target.parentNode.parentNode;
    const input_search = wrapper.querySelector(".selected-input");
    const dropdown = wrapper.querySelector(".dropdown-icon");
    // Get the options in the select to be unselected
    const option_to_unselect = wrapper.querySelector(`select option[value="${value_to_remove}"]`);
    option_to_unselect.removeAttribute("selected");
    // Remove token attribute
    e.target.parentNode.remove();
    input_search.focus();
    dropdown.classList.remove("active");
    const event = new Event('click');
    dropdown.dispatchEvent(event);
    e.stopPropagation();
}

// Listen for 2 sequence of hits on the delete key, if this happens delete the last token if exist
function deletePressed(e) {
    // const wrapper = e.target.parentNode.parentNode;
    // const input_search = e.target;
    // const key = e.keyCode || e.charCode;
    // const tokens = wrapper.querySelectorAll(".selected-wrapper");

    // if (tokens.length) {
    //     const last_token_x = tokens[tokens.length - 1].querySelector("a");
    //     let hits = +last_token_x.dataset.hits;

    //     if (key == 8 || key == 46) {
    //         if (!input_search.value) {

    //             if (hits > 1) {
    //                 // Trigger delete event
    //                 const event = new Event('click');
    //                 last_token_x.dispatchEvent(event);
    //             } else {
    //                 last_token_x.dataset.hits = 2;
    //             }
    //         }
    //     } else {
    //         last_token_x.dataset.hits = 0;
    //     }
    // }
    return true;
}

// You can call this function if you want to add new options to the select plugin
// Target needs to be a unique identifier from the select you want to append new option for example #multi-select-plugin
// Example of usage addOption("#multi-select-plugin", "tesla", "Tesla")
// function addOption(target, val, text) {

//     const select = document.querySelector(target);
//     let opt = document.createElement('option');
//    // opt.value = val;
//    // opt.innerHTML = text;
//     select.appendChild(opt);
// }

document.addEventListener("DOMContentLoaded", () => {

    // get select that has the options available
    const select = document.querySelectorAll("[data-multi-select-plugin]");
    select.forEach(select => {

        init(select);

    });

    // Dismiss on outside click
    document.addEventListener('click', () => {
        // get select that has the options available
        const select = document.querySelectorAll("[data-multi-select-plugin]");
        for (let i = 0; i < select.length; i++) {
            if (event) {
                var isClickInside = select[i].parentElement.parentElement.contains(event.target);

                if (!isClickInside) {
                    const wrapper = select[i].parentElement.parentElement;
                    const dropdown = wrapper.querySelector(".dropdown-icon");
                    const selected_label = wrapper.querySelector(".selected-wrapper");
                    const autocomplete_list = wrapper.querySelector(".autocomplete-list");
                    //the click was outside the specifiedElement, do something
                    dropdown.classList.remove("active");
                    autocomplete_list.innerHTML = "";
                    addPlaceholder(wrapper);
                    //console.log(wrapper);
                    //show_list();
                    
                }
            }
        }
    });
});

var options_selected_new = "";

function newoptioncheck(item) {
   options_selected_new = []
   options_selected_new.push(item);  
   console.log(options_selected_new[0]);

$('.selected-close').click( function(){ 

if(item.length == 1){
  goto_page(1);

}

 });
}
$(document.body).on('click', '.search_stage_filter' ,function(){ 
    show_list()
    goto_page(1);

});
</script>

<!-- get param without function END here by swaran -->
<script type="text/javascript">
  get_vehicles().then(function(data) {
    if (data.status) {
      if (data.response.list) {
        var options = "";
        options += `<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options += `<option value="` + item.id + `">` + item.name + `</option>`;
        })
        $('[data-filter="unit_type_id"]').html(options);
        // get param with function start here by swaran -->
        if (url_params.hasOwnProperty('unit_type_id')) {
          $("[data-filter='unit_type_id'] option[value=" + url_params.unit_type_id + "]").prop('selected', true);
          show_unit_filter({
            unit_type_id: url_params.unit_type_id
          })
        }
        // get param with function end here by swaran -->
      }
    }
  }).catch(function(err) {})
</script>
<!-- <script type="text/javascript">
  get_job_work().then(function(data) {
    if (data.status) {
      if (data.response.list) {
        var options = "";
        options += `<option value="">- - Select - -</option>`
        $.each(data.response.list, function(index, item) {
          options += `<option value="` + item.id + `">` + item.name + `</option>`;
        })
        $('[data-filter="job_work_id"]').html(options);
        if (url_params.hasOwnProperty('job_work_id')) {
          $("[data-filter='job_work_id'] option[value=" + url_params.job_work_id + "]").prop('selected', true);
        }
      }
    }
  }).catch(function(err) {})
</script> -->
<script>
var criticality = [];
$("[data-status-id-group]:checked").each(function() {
        criticality.push("'"+this.value+"'");
    });

</script>

<script>
  $(document).on('click','[data-status-id-group]',function(){
      criticality = [];
      $("[data-status-id-group]:checked").each(function() {
        criticality.push("'"+this.value+"'");
    });
    //goto_page(1);
  });
</script>

<datalist id="quick_list_vehicle_id"></datalist>
<script type="text/javascript">
  $(document.body).on('input', '[data-vehicle-id]' ,function(){
     id_selected=$(`[data-vehicle-id-rows="${$(this).val()}"]`).data('value');
    if(id_selected!=undefined){
     $(this).data('vehicle-id', id_selected)
     set_params('unit_id', id_selected)
     set_params('vehicle_code', $(`[data-vehicle-id]`).val())
     //goto_page(1)
    }
  });
  </script>

<script type="text/javascript">
  $(document.body).on('change', '[data-vehicle-id]', function() {
    id_selected = $(`[data-vehicle-id-rows="${$(this).val()}"]`).data('value');
    if (id_selected == undefined) {
      alert("Please enter correct Unit ID")
      set_params('unit_id', '')
      set_params('vehicle_code', '')
      $(`[data-vehicle-id]`).val('')
      //goto_page(1)
    }
  });
</script>
<script>
    get_repair_order_stage({}).then(function(data) {
    // Run this when your request was successful
    if(data.status){
    //Run this if response has list
    if(data.response.list)
    {
        var options = "";
        $.each(data.response.list, function(index, item) {
          options += `<option id="` + item.id + `" data-value="${item.name}" value="` + item.name + `"></option>`;
        })
        $('[data-filter="stage_id"]').html(options);
     
    }
  }
 
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
</script>

<script type="text/javascript">
  function show_unit_filter(param) {
    if (param.unit_type_id == '') {
     // $('[data-filter="unit_id"]').html('');
     $('#quick_list_vehicle_id').html('');
    }
    else if (param.unit_type_id == 'TRUCK') {
      quick_list_trucks().then(function(data) {
        if (data.status) {
          if (data.response.list) {
            var options = "";
           // options += `<option value="">- - Select - -</option>`
           options+=`<option data-vehicle-id-rows="" data-value="" value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
              options+=`<option data-vehicle-id-rows="`+item.code+`" data-value="${item.id}" value="`+item.code+`"></option>`;
             // options += `<option value="` + item.id + `">` + item.code + `</option>`;
            })
           // $('[data-filter="unit_id"]').html(options);
           $('#quick_list_vehicle_id').html(options);
            if (url_params.hasOwnProperty('vehicle_code')) {
              $(`[data-vehicle-id]`).val(check_url_params('vehicle_code'))
             // $("[data-filter='unit_id'] option[value=" + url_params.unit_id + "]").prop('selected', true);
            }
          }
        }
      }).catch(function(err) {})
    } else if (param.unit_type_id == 'TRAILER') {
      quick_list_trailers().then(function(data) {
        if (data.status) {
          if (data.response.list) {
            var options = "";
            options+=`<option data-vehicle-id-rows="" data-value="" value="">- - Select - -</option>`
           // options += `<option value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
              options+=`<option data-vehicle-id-rows="`+item.code+`" data-value="${item.id}" value="`+item.code+`"></option>`;
             // options += `<option value="` + item.id + `">` + item.code + `</option>`;
            })
           // $('[data-filter="unit_id"]').html(options);
           $('#quick_list_vehicle_id').html(options);
            if (url_params.hasOwnProperty('vehicle_code')) {
              $(`[data-vehicle-id]`).val(check_url_params('vehicle_code'))
             // $("[data-filter='unit_id'] option[value=" + url_params.unit_id + "]").prop('selected', true);
            }
          }
        }
      }).catch(function(err) {})
    }
  }
</script>
<script type="text/javascript">
  
  if(check_url_params('unit_type_id')){
    $('[data-filter="unit_id"]').prop('disabled', false);
  }else{
    $('[data-filter="unit_id"]').prop('disabled', 'disabled');
  }

$(document.body).on('change', '[data-filter="unit_type_id"]', function() {
  if($('[data-filter="unit_type_id"]').val() == 'TRUCK' || $('[data-filter="unit_type_id"]').val() == 'TRAILER' ){
    $('[data-filter="unit_id"]').prop('disabled', false);
  }else{
    $('[data-filter="unit_id"]').prop('disabled', 'disabled');
  }

})
</script>


<script type="text/javascript">
  function update_records_for_view() {
    show_processing_modal()
    $.ajax({
      url: '../user/maintenance/maintenance-dashboard/update-live-dashboard-pm',
      type: 'POST',
      data: {
        refreshname: 'Schedule_Unschedule'
      },
      success: function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
          if (data.status) {
            show_list()
            alert(data.message)
          } else {
            show_list()
            alert(data.message)
          }
          hide_processing_modal()
        }
      }
    })
  }
</script>

<script type="text/javascript">
  
  function show_list() {
    // check url for values or filters by default by swaran start here
    var sort_by_order_type = $('#sort').val();
    var sort_by = $('#sort_by').val();
    var page_no = (check_url_params('page_no') != undefined) ? check_url_params('page_no') : 1;
    var batch = (check_url_params('batch') != undefined) ? check_url_params('batch') : 10;
    var unit_type_id = check_url_params('unit_type_id')
    var unit_id = check_url_params('unit_id')
    var job_work_id = check_url_params('job_work_id')
    var followup_date = check_url_params('followup_date')
    var followup_end_date = check_url_params('followup_end_date')
    var followup_by = check_url_params('followup_by')
   
    var min_tat = check_url_params('min_tat')
    var max_tat = check_url_params('max_tat')
    // check url for values or filters by default by swar end here
    $.ajax({
      url: location.pathname + '-ajax',
      type: 'POST',
      data: {
        page: page_no,
        sort_by: sort_by,
        batch: batch,
        unit_type_id: unit_type_id,
        unit_id: unit_id,
        job_work_id: job_work_id,
        //criticality_level_id: criticality_level_id,
        followup_date: followup_date,
        followup_end_date: followup_end_date,
        sort_by_order_type:sort_by_order_type,
        followup_by: followup_by,
        stage_id_array: (options_selected_new[0])? options_selected_new[0].toString(): '',
        criticality_level: (criticality.length)? criticality.toString(): '',
        min_tat: min_tat,
        max_tat: max_tat
      },
      beforeSend: function() {
        show_table_data_loading('[data-ro-table]')
      },
      success: function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
          $('#tabledata').html("");
          if (data.status && unit_type_id) {
            $.each(data.response.list, function(index, item) 
            {
             
              
              sc_criticality_level = (item.sc_critical) ? item.sc_critical : ''
              sc_job_work = (item.sc_job_work) ? item.sc_job_work : '';
             
              /*if(check_url_params('followup_by')){
                if(!item.follow_sc_user_name.includes(check_url_params('followup_by'))){
                  return;
                }
              }*/
             
              un_criticality_level = (item.un_critical) ? item.un_critical : '';
              un_job_work = (item.un_job_work) ? item.un_job_work : '';

              
          

              var row = `<tr>
              <td>${item.sr_no}</td>`;
              if (unit_type_id == "") {
                row += `<td><span class="text-link">${item.unit_code}</span></td>`;
              }
              if (unit_type_id == "TRUCK") {
                row += `<td><span class="text-link" onclick="open_quick_view_truck('${item.unit_eid}')">${item.unit_code}</span></td>`;
              }
              if (unit_type_id == "TRAILER") {
                row += `<td><span class="text-link" onclick="open_quick_view_trailer('${item.unit_eid}')">${item.unit_code}</span></td>`;
              }
              row += `
              <td>${item.current_location}</td>`;


              if(item.sc_repairorder_id != '0'){
             row += ` <td class="darkblue"><span class="text-link"><a style="color:white;" href="../user/maintenance/repair-orders/details?eid=${item.sc_repairorder_eid}">${item.sc_repairorder_id}</span></td>`;
           }else{
            row += ` <td ></td>`;
           }


            row += `  <td>${item.sc_repairorder_date}</td>
            <!--<td>${item.sc_tat}</td>-->:
              <td>${item.sc_stage}</td>
              <td>${item.sc_vendor_name} ${item.sc_vendor_city_name} ${item.sc_vendor_state_name}</td>
              <td>${item.sc_type}</td>`;
              if (sc_criticality_level.indexOf('HIGH') >= 0) {
                row += `<td style="background-color:#ffcce0">HIGH</td>`;
              } else if (sc_criticality_level.indexOf('HIGH') <= -1 && sc_criticality_level.indexOf('MEDIUM') >= 0) {
                row += `<td style="background-color:#fff0b3">MEDIUM</td>`;
              } else {
                row += `<td style="background-color:white">${sc_criticality_level}</td>`;
              }
              row += `
             <td style="min-width:150px;text-align:left">${sc_job_work}</td>
             <td class="lightblue" style="min-width:250px; padding:0px 0px;">${item.sc_last_note}</td>
             <td class="lightblue">${item.sc_next_followup}</td>`;
              
            
              <?php
              if (in_array('P0228', USER_PRIV)) {
              ?>
                // if (item.repairorder_id !== "") {
                //   row += `<button class=""><a href="../user/maintenance/repair-orders/update?eid=${item.repairorder_eid}"></a></button>&nbsp;`;
                // } 
              <?php
              }
              if (in_array('P0229', USER_PRIV)) {
              ?>
                 if (item.sc_repairorder_id == "" || item.sc_repairorder_id == 0) {
                  row += `<td class="lightblue"></td>`;
                 }else{
                  row += `<td class="lightblue"><button class="btn_blue" style="padding: 2px 3px;" onclick="open_child_window({url:'../user/maintenance/repair-orders/add-followup&eid=${item.sc_repairorder_eid}',width:1000,height:600})">Followup</button></td>`;
                 }

                 row += `<td> ${item.follow_sc_user_code} ${item.follow_sc_user_name}<br> ${item.follow_sc_next_datetime}</td>`;
              <?php
              }
              if (in_array('P0232', USER_PRIV)) {
              ?>
                if (item.sc_repairorder_id == "" || item.sc_repairorder_id == 0) {
                  row += `<td></td>`;
                 }else{
                  row += `<td><button class="btn_blue" style="padding: 2px 3px;"><a href="../user/maintenance/work-orders/add-new?ro-eid=${item.sc_repairorder_eid}">Gen. WO</a></button></td>`;
                 }
              <?php
              } ?>
             


              if(item.un_repairorder_id == '0'){
             row += ` <td ></td>`;
           }else{
            
             row += `

              <td class="darkblue"><span class="text-link"><a style="color:white;" href="../user/maintenance/repair-orders/details?eid=${item.un_repairorder_eid}">${item.un_repairorder_id}</span></td> `;
           }


            row += ` <td>${item.un_repairorder_date}</td>
            <td>${item.un_tat}</td>
              <td>${item.un_stage}</td>
              <td>${item.un_vendor_name} ${item.un_vendor_city_name} ${item.un_vendor_state_name}</td>
              <td>${item.un_type}</td>`;
              if (un_criticality_level.indexOf('HIGH') >= 0) {
                row += `<td style="background-color:#ffcce0">HIGH</td>`;
              } else if (un_criticality_level.indexOf('HIGH') <= -1 && un_criticality_level.indexOf('MEDIUM') >= 0) {
                row += `<td style="background-color:#fff0b3">MEDIUM</td>`;
              } else {
                row += `<td style="background-color:white">${un_criticality_level}</td>`;
              }
              row += `
             <td style="min-width:150px;text-align:left">${un_job_work}</td>
             <td class="lightblue" style="min-width:250px; padding:0px 0px;">${item.un_last_note}</td>
             <td class="lightblue">${item.un_next_followup}</td>`;
            

              <?php
              if (in_array('P0228', USER_PRIV)) {
              ?>
                // if (item.repairorder_id !== "") {
                //   row += `<button class=""><a href="../user/maintenance/repair-orders/update?eid=${item.repairorder_eid}"></a></button>&nbsp;`;
                // }
              <?php
              }
              if (in_array('P0229', USER_PRIV)) {
              ?>
                 if (item.un_repairorder_id == "" || item.un_repairorder_id == 0) {
                  row += `<td class="lightblue"></td>`;
                 }else{
                row += `<td class="lightblue"><button class="btn_blue" style="padding: 2px 3px;" onclick="open_child_window({url:'../user/maintenance/repair-orders/add-followup&eid=${item.un_repairorder_eid}',width:1000,height:600})">Followup</button></td>`;
                 }


                  row += `<td> ${item.follow_uc_user_code} ${item.follow_uc_user_name}<br> ${item.follow_uc_next_datetime}</td>`;


                  
              <?php
              }
              if (in_array('P0232', USER_PRIV)) {
              ?>
                 if (item.un_repairorder_id == "" || item.un_repairorder_id == 0) {
                  row += `<td></td>`;
                 }else{ 
                row += `<td><button class="btn_blue" style="padding: 2px 3px;"><a href="../user/maintenance/work-orders/add-new?ro-eid=${item.un_repairorder_eid}">Gen. WO</a></button></td>`;
                 }
              <?php
              } ?>
            

            row+= `</tr>`;
              $('#tabledata').append(row);
            })

            $('#highcount').text(data.response.highcount);
            $('#mediumcount').text(data.response.mediumcount);
            $('#lowcount').text(data.response.lowcount);

            set_pagination({
              selector: '[data-pagination]',
              totalPages: data.response.totalPages,
              currentPage: data.response.currentPage,
              batch: data.response.batch
            })
          } 
          else if (!unit_type_id){
            $('#tabledata').html("");
    var row=`<tr><td colspan="20">Please select Unit Type</td></tr>`;
    $('#tabledata').append(row);
      $('[data-pagination]').html('');
          }else {
            $('#tabledata').html("");
    var row=`<tr><td colspan="25">`+data.message+`</td></tr>`;
    $('#tabledata').append(row);
      $('[data-pagination]').html('');
          }
        }
      }
    })
  }
  show_list()

  function compareTwo(result1, result2)
  {
   if(result2.length == 1){
     if(result2[0] == 'MEDIUM'){
       if(result1.length == 1 && result1[0] == 'MEDIUM'){
        return true;
       }
       else{ 
         return false;
       }
     }
     else { //result1[0] == 'HIGH'
      if(result1.includes(result2[0])) {
          return true;
        }
        return false;
     }
   }
   else{
    for(let i = 0; i < result2.length; i++) { 
        if(result1.includes(result2[i])) {
          return true;
        }
    }
    return false; // no match found
   }
    
  }
</script>
<script type="text/javascript">
  function on_change_class(value) {
    show_list();
    //show_type_filter({class:value});
  }
</script>
<script type="text/javascript">
  function sort_table() {
    show_list()
  }
</script>


<!-- <script type="text/javascript">
  $(window).on('popstate', function() {
    location.reload(true);
  });
</script> -->
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>