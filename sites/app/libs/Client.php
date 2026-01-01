<?php
class Client
{
	public static function alert($type, $text)
	{
		if (CLIENT_URL == 'agora')
		{
			if ($type == 'success') {
				return '<div class="Success-Box">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="Danger-Box">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="Info-Box">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="Warning-Box">' . $text . '</div>';
			}
		}
		
		if (CLIENT_URL == 'desert-angel')
		{
			if ($type == 'success') {
				return '<div class="alert alert-success">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="alert alert-danger">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="alert alert-info">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="alert alert-warning">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'mai-siyah')
		{
			if ($type == 'success') {
				return '<div class="alert alert-success">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="alert alert-danger">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="alert alert-info">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="alert alert-warning">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'exotic')
		{
			if($type == 'success'){
				return '<div class="error-holder">
                        <div class="green wide fading-notification" align="left"><span class="error_icons success"></span>
                            <p>'.$text.'</p>
                        </div>
                    </div>';
			}elseif ($type == 'error'){
				return '<div class="error-holder">
                        <div class="red wide fading-notification" align="left"><span class="error_icons atention"></span>
                            <p>'.$text.'</p>
                        </div>
                    </div>';
			}elseif ($type == 'info'){
				return '<div class="error-holder">
                        <div class="light_brown wide fading-notification" align="left"><span class="error_icons atention"></span>
                            <p>'.$text.'</p>
                        </div>
                    </div>';
			}elseif ($type == 'warning'){
				return '<div class="alert alert-warning">'.$text.'</div>';
			}
		}

		if (CLIENT_URL == "gyroscope")
		{
			if($type == 'success'){
				return '<div id="validation"><span class="success"><p>'.$text.'</p></span></div>';
			}elseif ($type == 'error'){
				return '<div id="validation"><span class="error"><p>'.$text.'</p></span></div>';
			}elseif ($type == 'info'){
				return '<div id="validation"><span class="warning"><p>'.$text.'</p></span></div>';
			}elseif ($type == 'warning'){
				return '<div class="alert alert-warning">'.$text.'</div>';
			}
		}

		if (CLIENT_URL == "metin2-tr")
		{
			if ($type == 'success') {
				return '<div class="alert alert-success">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="alert alert-danger">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="alert alert-info">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="alert alert-warning">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'neo-wheat')
		{
			if ($type == 'success') {
				return '<div class="callout callout-success">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="callout callout-danger">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="callout callout-info">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="callout callout-warning">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'neo-blue')
		{
			if ($type == 'success') {
				return '<div class="callout callout-success">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="callout callout-danger">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="callout callout-info">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="callout callout-warning">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'trip-of-india')
		{
			if ($type == 'success') {
				return '<div class="callout callout-success">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="callout callout-danger">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="callout callout-info">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="callout callout-warning">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'zai')
		{
			if ($type == 'success') {
				return '<div class="callout callout-success">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="callout callout-danger">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="callout callout-info">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="callout callout-warning">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'eternal')
		{
			if ($type == 'success') {
				return '<div class="callout callout-success">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="callout callout-danger">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="callout callout-info">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="callout callout-warning">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'neo-red')
		{
			if ($type == 'success') {
				return '<div class="callout callout-success">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="callout callout-danger">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="callout callout-info">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="callout callout-warning">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'darkness')
		{
			if ($type == 'success') {
				return '<div class="callout callout-success">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="callout callout-danger">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="callout callout-info">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="callout callout-warning">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'diabolic')
		{
			if ($type == 'success') {
				return '<div class="callout callout-success">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="callout callout-danger">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="callout callout-info">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="callout callout-warning">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'flashback')
		{
			if ($type == 'success') {
				return '<div class="callout callout-success">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="callout callout-danger">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="callout callout-info">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="callout callout-warning">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'spiritual')
		{
			if ($type == 'success') {
				return '<div class="callout callout-success">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="callout callout-danger">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="callout callout-info">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="callout callout-warning">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'serenity')
		{
			if ($type == 'success') {
				return '<div class="callout callout-success">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="callout callout-danger">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="callout callout-info">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="callout callout-warning">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'turtle')
		{
			if ($type == 'success') {
				return '<div class="Success-Box">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="Danger-Box">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="Info-Box">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="Warning-Box">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'lodos')
		{
			if ($type == 'success') {
				return '<div class="Success-Box">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="Danger-Box">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="Info-Box">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="Warning-Box">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'perseus')
		{
			if ($type == 'success') {
				return '<div class="Success-Box">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="Danger-Box">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="Info-Box">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="Warning-Box">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'artemis')
		{
			if ($type == 'success') {
				return '<div class="callout callout-success">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="callout callout-danger">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="callout callout-info">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="callout callout-warning">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'atemu')
		{
			if ($type == 'success') {
				return '<div class="callout callout-success">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="callout callout-danger">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="callout callout-info">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="callout callout-warning">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'electra')
		{
			if ($type == 'success') {
				return '<div class="Success-Box">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="Danger-Box">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="Info-Box">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="Warning-Box">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'vesta')
		{
			if ($type == 'success') {
				return '<div class="callout callout-success">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="callout callout-danger">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="callout callout-info">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="callout callout-warning">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'soldex')
		{
			if ($type == 'success') {
				return '<div class="Success-Box">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="Danger-Box">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="Info-Box">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="Warning-Box">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'razer')
		{
			if ($type == 'success') {
				return '<div class="Success-Box">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="Danger-Box">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="Info-Box">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="Warning-Box">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'aspar')
		{
			if ($type == 'success') {
				return '<div class="callout callout-success">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="callout callout-danger">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="callout callout-info">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="callout callout-warning">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'blackberry')
		{
			if ($type == 'success') {
				return '<div class="Success-Box">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="Danger-Box">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="Info-Box">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="Warning-Box">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'pour')
		{
			if ($type == 'success') {
				return '<div class="Success-Box">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="Danger-Box">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="Info-Box">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="Warning-Box">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'crow')
		{
			if ($type == 'success') {
				return '<div class="alert alert-success">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="alert alert-danger">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="alert alert-info">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="alert alert-warning">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'duke')
		{
			if ($type == 'success') {
				return '<div class="alert alert-success">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="alert alert-danger">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="alert alert-info">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="alert alert-warning">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'viper')
		{
			if ($type == 'success') {
				return '<div class="alert alert-success">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="alert alert-danger">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="alert alert-info">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="alert alert-warning">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'zodiac')
		{
			if ($type == 'success') {
				return '<div class="Success-Box">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="Danger-Box">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="Info-Box">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="Warning-Box">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'tornado')
		{
			if ($type == 'success') {
				return '<div class="Success-Box">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="Danger-Box">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="Info-Box">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="Warning-Box">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'felix')
		{
			if ($type == 'success') {
				return '<div class="Success-Box">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="Danger-Box">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="Info-Box">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="Warning-Box">' . $text . '</div>';
			}
		}
		
		if (CLIENT_URL == 'rodi')
		{
			if ($type == 'success') {
				return '<div class="alert alert-success">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="alert alert-danger">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="alert alert-info">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="alert alert-warning">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'fancy')
		{
			if ($type == 'success') {
				return '<div class="alert alert-success">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="alert alert-danger">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="alert alert-info">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="alert alert-warning">' . $text . '</div>';
			}
		}

		if (CLIENT_URL == 'lake')
		{
			if ($type == 'success') {
				return '<div class="Success-Box">' . $text . '</div>';
			} elseif ($type == 'error') {
				return '<div class="Danger-Box">' . $text . '</div>';
			} elseif ($type == 'info') {
				return '<div class="Info-Box">' . $text . '</div>';
			} elseif ($type == 'warning') {
				return '<div class="Warning-Box">' . $text . '</div>';
			}
		}
	}
}