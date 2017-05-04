<?php
namespace Page;

class Login
{

     public static $wpUserNameField = 'input#user_login';
     public static $wpPasswordField = 'input#user_pass';
     public static $wpSubmitButton = 'input#wp-submit';
     public static $loginLink = 'li#wp-admin-bar-bp-login';
     public static $dashBoardMenu = 'li#menu-dashboard';

    public static function route($param)
    {
        return static::$URL.$param;
    }

    protected $tester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
    }

    public function login( $name, $password )
    {
        $I = $this->tester;

        $I->amOnPage( '/' );
        $I->fillField( self::$userNameField, $name );
        $I->fillField( self::$passwordField, $password );
        $I->click( self::$loginButton );
        $I->seeInTitle( self::$titleTag );

        return $this;

    }

    public function loginAsAdmin( $wpUserName, $wpPassword )
    {
        $I = $this->tester;

        $I->amOnPage( '/wp-admin' );
        $I->wait( 10 );

        $I->seeElement( self::$wpUserNameField );
        $I->fillfield( self::$wpUserNameField,$wpUserName );

        $I->seeElement( self::$wpPasswordField );
        $I->fillfield( self::$wpPasswordField, $wpPassword );

        $I->seeElement( self::$wpSubmitButton );
        $I->click( self::$wpSubmitButton );
        $I->wait( 10 );

        $I->seeElement( self::$dashBoardMenu );

        $I->maximizeWindow();

    }

}
