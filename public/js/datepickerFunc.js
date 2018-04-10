function form_dates() {
$('.form_date').datetimepicker({
      language:  'en',
      weekStart: 1,
      todayBtn:  1,
  autoclose: 1,
  todayHighlight: 1,
  startView: 2,
  minView: 2,
  forceParse: 0
}); }
function DaterangeSelect() {
  $('input[name="datepickerInput"]').daterangepicker({
    locale: { format: 'DD/MM/YYYY' },
    language:  'en',
    weekStart: 1,
    todayBtn:  1,
autoclose: 1,
todayHighlight: 1,
startView: 2,
minView: 2,
forceParse: 0 });
}
