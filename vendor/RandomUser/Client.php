<?php

namespace RandomUser;

/**
 * https://randomuser.me/documentation
 */
class Client {

    const ENDPOINT = 'https://randomuser.me/api/';
    const PARAM_GENDER = 'gender';
    const GENDER_FEMALE = 'female';
    const GENDER_MALE = 'male';
    const PARAM_FORMAT = 'format';
    const FORMAT_JSON = 'JSON'; // default
    const FORMAT_PRETTY = 'PrettyJSON'; // or pretty
    const FORMAT_CSV = 'CSV';
    const FORMAT_YAML = 'YAML';
    const FORMAT_XML = 'XML';

    /**
     * Nationalities<br/>
     * You can request a different nationality of a randomuser.<br/>
     * Pictures won't be affected by this, but data such as location, cell/home phone, id, etc. will be more appropriate.<br/>
     * Currently, randomuser offers these nationalities:
     * <ul>
     * <li>v1.0: AU, BR, CA, CH, DE, DK, ES, FI, FR, GB, IE, IR, NL, NZ, TR, US</li>
     * <li>v1.1: AU, BR, CA, CH, DE, DK, ES, FI, FR, GB, IE, IR, NL, NZ, TR, US</li>
     * </ul>
     * You can specify a nationality like so:
     * <pre>https://randomuser.me/api/?nat=gb</pre>
     * Randomuser will return random nats by default. You can have some control with the nats that you'd like to have generated by specifying a comma seperated list:
     * <pre>https://randomuser.me/api/?nat=us,dk,fr,gb</pre>
     */
    const PARAM_NAT = 'nat'; // AU, BR, CA, CH, DE, DK, ES, FI, FR, GB, IE, IR, NL, NZ, TR, US
    const PARAM_RESULTS = 'results';
    const PARAM_PAGE = 'page';
    const PARAM_SEED = 'seed';

    /**
     * Download the results with the appropriate format extension.
     * <pre>https://randomuser.me/api/?results=25&nat=gb,us,es&format=csv&dl</pre>
     */
    const PARAM_DL = 'dl';

    /**
     * If you only want the data, and don't care for seed, results, page, and version data.
     * <pre>https://randomuser.me/api/?results=5&inc=name,gender,nat&noinfo</pre>
     */
    const PARAM_NOINFO = 'noinfo';

    /**
     * If you want the payload in JSONP, supply a callback using the callback parameter. Only available with JSON formats.
     * <pre>https://randomuser.me/api/?results=5&callback=randomuserdata</pre>
     */
    const PARAM_CALLBACK = 'callback';

    /**
     * <ul>
     * <li>gender</li>
     * <li>name</li>
     * <li>location</li>
     * <li>email</li>
     * <li>login</li>
     * <li>registered</li>
     * <li>dob</li>
     * <li>phone</li>
     * <li>cell</li>
     * <li>id</li>
     * <li>picture</li>
     * <li>nat</li>
     * </ul>
     */
    const PARAM_INCLUDING = 'inc';
    const PARAM_EXCLUDING = 'exc';

    function __construct() {
        
    }

    function call($params = array(), $misc = NULL) {

        $url = self::ENDPOINT;

        if (empty($params) == FALSE) {
            $url .= '?' . http_build_query($params);

            if (empty($misc) == FALSE) {
                $url .= '&' . $misc;
            }
        } else {
            if (empty($misc) == FALSE) {
                $url .= '?' . $misc;
            }
        }

        return curlRequest($url);
    }

}