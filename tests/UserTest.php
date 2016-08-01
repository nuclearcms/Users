<?php


class UserTest extends TestBase {

    /** @test */
    function it_is_instantiatible()
    {
        $this->assertInstanceOf(
            'Nuclear\Users\User',
            new Nuclear\Users\User
        );
    }

}