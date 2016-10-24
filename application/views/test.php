
<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>

<script>
var data = (<?php echo $rat?>);
console.log(data);
var selectedoption;
$.each(data.departments, function(key, value) {
  $('#mySelect')
      .append($("<option></option>")
                 .attr("value",data.departments[key].department_id)
                 .text(data.departments[key].department_name));
  if(mydepartment == data.departments[key].department_id){
    selectedoption = data.departments[key].department_id
  }
});
$("#selectid").val(selectedoption);

</script>
