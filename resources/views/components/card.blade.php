@props(['highlight' => false])

<div @class(['highlight' => $highlight, 'card mb-8']) >
  {{ $slot }}
  <a {{ $attributes }} class="btn nzl nzp nzu nzz oab oad oae oaj">View Details</a>
</div>