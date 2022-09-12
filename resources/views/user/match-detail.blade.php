@extends('user.template')
@section('content')
<div class="row g-5">
    <div class="col-12 col-md-12">
        <div class="bg-main p-3 mt-5">
            <h2>Komoverse Auto-Chess Match Detail</h2>
            <hr>
            <h4>Match ID: {{ $match_id }}</h4>
            <hr>
            <h4>Match Result</h4>
            @foreach ($autochess as $row)
            <div class="history-wrapper-sm history-p{{ $row->placement }}" data-matchid="{{ $row->match_id }}">
                <div class="row">
                    <div style="width: 15%">
                        <span class="placement">#{{ $row->placement }}</span>
                        <span class="name">{{ $row->display_name }}</span>
                    </div>
                    <div style="width: 19%">
                        <span class="lineup">LINEUP</span>
                        @php
                            $lineup = json_decode($row->lineup);
                            for ($star=3; $star > 0; $star--):
                                foreach ($lineup as $key => $value):
                                    $heroes_array = explode('*', $key);
                                    if ($heroes_array[0] == $star):
                        @endphp
                                <div class="lineup-icon">
                                    <img src="{{ url('assets/img/heroes-icon/'.$heroes_array[1].'.webp') }}" alt="{{ $heroes_array[1] }} icon" class="heroes-icon" onError="this.onerror=null;this.src='{{ url('assets/img/nopic.webp') }}';" 
        data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-title="{{ ucwords(str_replace('_', ' ', $heroes_array[1])) }}">
                                    <img src="{{ url('assets/img/'.$heroes_array[0].'-star.png') }}" class="star">
                                </div>
                        @php
                                    endif;
                                endforeach;
                            endfor;
                        @endphp
                    </div>

                    <div style="width: 15%">
                        <span class="lineup">SYNERGY</span>
                        @php
                            $synergy = json_decode($row->synergy);
                            foreach ($synergy as $key => $value):
                        @endphp
                            <div class="lineup-icon">
                                <img src="{{ url('assets/img/synergy-icon/icon-'.$key.'.webp') }}" alt="{{ $key }} icon" class="synergy-icon"  onError="this.onerror=null;this.src='{{ url('assets/img/nopic.webp') }}';" 
        data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-title="{{ ucwords(str_replace('_', ' ', $key)) }}">
                                <div class="synergy-wrapper">
                                    @for ($i = 1; $i <= $value; $i++)
                                    <img src="{{ url('assets/img/yellow-box.png') }}" alt="icon" class="synergy-value">
                                    @endfor
                                </div>
                            </div>
                        @php
                            endforeach;
                        @endphp
                    </div>

                    <div style="width: 12%">
                        <span class="lineup">ITEMS</span>
                        @php
                            $buff_items = json_decode($row->buff_items);
                            foreach ($buff_items as $key => $value):
                                for ($x=1; $x <= $value; $x++):
                        @endphp
                            <div class="lineup-icon">
                                <img src="{{ url('assets/img/items-icon/'.$key.'.webp') }}" alt="{{ $key }} icon" class="items-icon"  onError="this.onerror=null;this.src='{{ url('assets/img/nopic.webp') }}';" 
        data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-title="{{ ucwords(str_replace('_', ' ', $key)) }}">
                            </div>
                        @php
                                endfor;
                            endforeach;
                        @endphp
                    </div>

                    <div style="width: 7%">
                        <span class="kd_ratio">
                            W / L
                        </span>
                            <span class="kill">{{ $row->win }}</span>
                            <span class="death">{{ $row->lose }}</span>
                    </div>

                    <div style="width: 9%">
                        <span class="kd_ratio">
                            K / D
                        </span>
                            <span class="kill">{{ $row->heroes_kill }}</span>
                            <span class="death">{{ $row->heroes_death }}</span>
                    </div>

                    <div style="width: 10%">
                        <span class="kd_ratio">
                            Damage
                        </span>
                            <span class="kill">{{ number_format($row->damage_given) }}</span>
                            <span class="death">{{ number_format($row->damage_taken) }}</span>
                    </div>

                    <div style="width: 10%">
                        <span class="kd_ratio">
                            Duration
                        </span>
                            <span class="duration">{{ $row->duration }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection