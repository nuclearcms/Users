<?php


class RoleTest extends TestBase {

    /** @test */
    function it_is_instantiatible()
    {
        $this->assertInstanceOf(
            'Nuclear\Users\Role',
            new Nuclear\Users\Role
        );
    }

}