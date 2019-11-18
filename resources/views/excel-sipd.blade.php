

<table>
  <thead>
    <tr>
      <th>Daerah</th>
      <th>Excel</th>

    </tr>
  </thead>
  <tbody>
  <?php foreach ($datas as $key => $value): ?>

    <tr>
      <td> {!!$value['namapemda']!!}</td>
      <td> <a href="{{url('excel-download')}}?kodepemda={{$value['kodepemda']}}">Download</a> </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
