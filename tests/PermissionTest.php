<?php


class PermissionTest extends TestBase {

    /** @test */
    function it_is_instantiatible()
    {
        $this->assertInstanceOf(
            'Nuclear\Users\Permission',
            new Nuclear\Users\Permission
        );
    }

}