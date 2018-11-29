<style>
    .map-location-search-wrapper {
        position: relative;
        margin-top: 10px;
        margin-left: 10px;
        z-index: 3;
    }

    .map-location-search {
        position: absolute;
        background-color: #fff;
        border: 1px solid #bbb;
        border-radius: 3px;
        -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .25);
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .25);
    }

    .map-location-search [class*=ti-] {
        position: absolute;
        top: 0;
        left: 0;
        width: 40px;
        height: 40px;
        line-height: 40px;
        text-align: center;
    }

    #map-location-search {
        -webkit-transition: all .175s cubic-bezier(.4, 0, .2, 1);
        -o-transition: all .175s cubic-bezier(.4, 0, .2, 1);
        transition: all .175s cubic-bezier(.4, 0, .2, 1);
        position: relative;
        width: 40px;
        height: 40px;
        -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .25);
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .25);
        opacity: 0;
        cursor: pointer;
    }


    #map-location-search:focus {
        width: 250px;
        border: none;
        opacity: 1;
        cursor: text;
    }
</style>