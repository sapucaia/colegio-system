<?php

return array(
    "development" => array(
//        "adapter" => "oci8",
        "adapter" => "postgres",
//        "adapter" => "mssqlnative",
        "host" => "localhost",
        "database" => "colegio",
        "user" => "colegio",
        "password" => "colegiosystem",
        "port" => 5432
    ),
    "data_migration" => array(
        "adapter" => "oci8",
        "origin" => array(
//            "adapter" => "oci8",
//            "adapter" => "postgres",
            "adapter" => "mssqlnative",
            "host" => "localhost",
//            "database" => "base",
            "database" => "colegio",
//            "database" => "colegioc",
            "user" => "paavo",
            "password" => "paavo",
            "port" => 1521
        ),
        "destine" => array(
//            "adapter" => "oci8",
            "adapter" => "postgres",
//            "adapter" => "mssqlnative",
            "host" => "localhost",
            "database" => "base",
//            "database" => "colegio",
            "user" => "paavo",
            "password" => "paavo",
            "port" => 1521
        ),
    ),
    "distributed" => array(
        "development" => array(
            "adapter" => "oci8",
            "colegio.livia-windows" => array(
                "adapter" => "oci8",
                "host" => "computador",
                "database" => "colegioc",
                "user" => "paavo",
                "password" => "paavo",
                "port" => 1521
            ),
            "colegio.computador" => array(
                "adapter" => "oci8",
                "host" => "computador",
                "database" => "colegio",
                "user" => "paavo",
                "password" => "paavo",
                "port" => 1521
            )
        )
    )
);
?>
