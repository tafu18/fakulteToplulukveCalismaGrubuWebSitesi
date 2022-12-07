<?php require_once 'header.php';
require_once 'db.php';

$query = $db->prepare("SELECT Count(*) AS etkinlik FROM `content` WHERE `type` = 0");
$query->execute();
$events = $query->fetch(PDO::FETCH_ASSOC);

$query = $db->prepare("SELECT Count(*) AS etkinlik FROM `content` WHERE `type` = 0 AND end > CURRENT_DATE()");
$query->execute();
$event = $query->fetch(PDO::FETCH_ASSOC);

$query = $db->prepare("SELECT Count(*) AS duyuru FROM `content` WHERE `type` = 1");
$query->execute();
$annoucements = $query->fetch(PDO::FETCH_ASSOC);

$query = $db->prepare("SELECT Count(*) AS duyuru FROM `content` WHERE `type` = 1 AND end > CURRENT_DATE()");
$query->execute();
$annoucement = $query->fetch(PDO::FETCH_ASSOC);

$query = $db->prepare("SELECT * FROM `content`WHERE end > CURRENT_DATE()");
$query->execute();
$lists = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<html ng-app="toplulukApp" ng-controller="toplulukCtrl">
<div class="container mb-5 mt-10">
    <div class="row">
        <div class="col-md-3 mt-3 mb-5 container">
            <div class="container">
                <div class="row justify-content-center-2 badge-primary rounded">
                    <span class="badge mr-3">Toplam Etkinlik Sayısı: <?php echo " " . $events['etkinlik'];?></span>
                    <span class="badge">Aktif Etkinlik Sayısı:<?php echo " " . $event['etkinlik'];?></span>
                </div>

                <div class="row mt-2 justify-content-center-2 badge-success rounded">
                    <span class="badge mr-3">Toplam Duyuru Sayısı: <?php echo " " . $annoucements['duyuru'];?></span>
                    <span class="badge">Aktif Duyuru Sayısı: <?php echo " " . $annoucement['duyuru'];?></span>
                </div>
            </div>
            <div class="mt-3 container">
                <div class="row justify-content-center-2">
                <h5 class="display-4 mb-2" style="font-size: 1.7rem;">Etkinlikler/Duyurular</h5>
                    <ul class="list-group list-group-flush" style="width: 100%;">
                        <?php foreach($lists as $list){
                            if($list['type'] == 0 ){?>
                                <a style="color: white!important;" href="events.php?event_id=<?php echo $list['id'];?>"><li class="list-group-item rounded" style="background-color: #007bff;"><?php echo $list['title'];?></li></a>
                            <?php } else{ ?>
                                <!-- <li class="list-group-item rounded" style="background-color: #28a745;"><a style="color: white!important;" href="events.php?event_id=<?php echo $list['id'];?>"><?php echo $list['title'];?></a></li> -->
                                <a style="color: white!important;" href="events.php?event_id=<?php echo $list['id'];?>"><li class="list-group-item rounded" style="background-color: #28a745;"><?php echo $list['title'];?></li></a>
                            <?php }}?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div id='calendar'></div>
        </div>
    </div>
</div>


    
<?php require_once 'footer.html';?>


<?php 

$query = $db->prepare("SELECT * FROM `content`");
$query->execute();
$events_annoucements = $query->fetchAll(PDO::FETCH_ASSOC);

foreach($events_annoucements as $event_annoucement){
    //color change
    if($event_annoucement['end'] < date("Y-m-d")) $color = "#909090";
    else{
        if($event_annoucement['type'] == 1) $color = '#28a745';
        else $color = '#007bff';
    }
    $items[] = array(
        'title' => $event_annoucement['title'],
        'start' => date("Y-m-d", strtotime($event_annoucement['start'])) . "T" . $event_annoucement['start_time'] ,
        'end' => date("Y-m-d", strtotime($event_annoucement['end'])) . "T" . $event_annoucement['end_time'] ,
        'color' => $color,
        'url' => "events.php?event_id=".$event_annoucement['id']
    );
};
?>
<script>
var items = <?php echo json_encode($items)?>;
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialDate: new Date(),
      initialView: 'dayGridMonth',
      locale: 'tr',
      navLinks: 'true',
      headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek',
      },
      buttonText:{
          today: 'Bugün',
          month: 'Aylık',
          week: 'Haftalık'
      },
      allDayText: 'Tüm Gün',
      events: items,
        /* events: [
          {
              title:'Deneme',
              start:'2021-11-25',
              end:'2021-11-25',
              
          },
          {
              title:'Test',
              start:'2021-11-30',
              end:'2021-11-30',
              color:'blue',
          },
          {
              title:'Test Deneme',
              start:'2021-11-25',
              end:'2021-11-30',
              color:'lightgreen',
          }
      ]  */
    });
    calendar.render();
  });





</script>