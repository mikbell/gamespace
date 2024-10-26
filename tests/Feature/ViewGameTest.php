<?php

it('returns correct game info', function () {
    $response = $this->get(route('games.show', 'dragon-ball-sparking-zero'));

    $response->assertOk();
});
