@extends('layouts.app')
@if (count($keywords)==0)
     <p color='red'> There are no records in the database!</p> 
@else  
<table border="1">
    <tr>
     <td> Calendar Keywords </td>
    <td>  </td>
    <td>  </td>
   </tr>
  @foreach ($keywords as $keywords)
   <tr>
    <td> {{ $keywords->name}} </td>
    <td> <input type="button" value="show calendar" onclick="showCalendar({{ $keywords->id }})"> </td>                     
    <td> <form method="POST" action="{{ action('CalendarController@destroy', $keywords->id) }}">@csrf @method('DELETE')<input type="submit" value="delete"></form> </td>
   </td>
  @endforeach
  </table>
 @endif
 <p> <input type="button" value="New Calendar"> </p> 
 
<script>  function showCalendar(keywordID) {   window.location.href="/calendar/"+keywordID;  } </script> 