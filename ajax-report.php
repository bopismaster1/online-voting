 <?php
    include "connect.php";
    $sql = "SELECT candidateId, COUNT(*) as 'voteCount' FROM votes GROUP BY candidateId";
    $voteCountResult = select_info_multiple_key($sql);
    $sql = "Select * from candidates";
    $CandidateList = select_info_multiple_key($sql);

    ?>
 <canvas id="myChart" height="100px"></canvas>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script>
     var votesObject = <?php echo json_encode($voteCountResult) ?>;
     var candidateList = <?php echo json_encode($CandidateList) ?>;

     console.log(votesObject);
     console.log(candidateList);
     const ctx = document.getElementById('myChart').getContext('2d');
     const myChart = new Chart(ctx, {
         type: 'bar',
         data: {
             labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
             datasets: [{
                 label: '# of Votes',
                 data: [12, 19, 3, 5, 2, 3],
                 backgroundColor: [
                     'rgba(255, 99, 132, 0.2)',
                     'rgba(54, 162, 235, 0.2)',
                     'rgba(255, 206, 86, 0.2)',
                     'rgba(75, 192, 192, 0.2)',
                     'rgba(153, 102, 255, 0.2)',
                     'rgba(255, 159, 64, 0.2)'
                 ],
                 borderColor: [
                     'rgba(255, 99, 132, 1)',
                     'rgba(54, 162, 235, 1)',
                     'rgba(255, 206, 86, 1)',
                     'rgba(75, 192, 192, 1)',
                     'rgba(153, 102, 255, 1)',
                     'rgba(255, 159, 64, 1)'
                 ],
                 borderWidth: 1
             }]
         },
         options: {
             scales: {
                 y: {
                     beginAtZero: true
                 }
             }
         }
     });
 </script>