<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{

	/**
	 * @var string
	 */
	public $fromEmail;

	/**
	 * @var string
	 */
	public $fromName;

	/**
	 * @var string
	 */
	public $recipients;

	/**
	 * The "user agent"
	 *
	 * @var string
	 */
	public $userAgent = 'CodeIgniter';

	/**
	 * The mail sending protocol: mail, sendmail, smtp
	 *
	 * @var string
	 */
	public $protocol = 'smtp';

	/**
	 * The server path to Sendmail.
	 *
	 * @var string
	 */
	public $mailPath = '/usr/sbin/sendmail';

	/**
	 * SMTP Server Address
	 *
	 * @var string
	 */
	// 	public $SMTPHost = 'srv133.niagahoster.com';
	public $SMTPHost = 'server.kntechline.com';

	/**
	 * SMTP Username
	 *
	 * @var string
	 */
	// 	public $SMTPUser = 'pesawaran.ppdb@ngehoster.com';
	public $SMTPUser = 'pesawaran.ppdb@kntechline.com';

	/**
	 * SMTP Password
	 *
	 * @var string
	 */
	public $SMTPPass = 'Baseng@123';
	// 	public $SMTPPass = 'Kominfo@2020';

	/**
	 * SMTP Port
	 *
	 * @var integer
	 */
	// 	public $SMTPPort = 465;
	public $SMTPPort = 587;

	/**
	 * SMTP Timeout (in seconds)
	 *
	 * @var integer
	 */
	public $SMTPTimeout = 5;

	/**
	 * Enable persistent SMTP connections
	 *
	 * @var boolean
	 */
	public $SMTPKeepAlive = false;

	/**
	 * SMTP Encryption. Either tls or ssl
	 *
	 * @var string
	 */
	// 	public $SMTPCrypto = 'ssl';
	public $SMTPCrypto = '';

	/**
	 * Enable word-wrap
	 *
	 * @var boolean
	 */
	public $wordWrap = true;

	/**
	 * Character count to wrap at
	 *
	 * @var integer
	 */
	public $wrapChars = 76;

	/**
	 * Type of mail, either 'text' or 'html'
	 *
	 * @var string
	 */
	public $mailType = 'html';

	/**
	 * Character set (utf-8, iso-8859-1, etc.)
	 *
	 * @var string
	 */
	// 	public $charset = 'UTF-8';
	public $charset = 'iso-8859-1';

	/**
	 * Whether to validate the email address
	 *
	 * @var boolean
	 */
	public $validate = false;

	/**
	 * Email Priority. 1 = highest. 5 = lowest. 3 = normal
	 *
	 * @var integer
	 */
	public $priority = 1;

	/**
	 * Newline character. (Use “\r\n” to comply with RFC 822)
	 *
	 * @var string
	 */
	public $CRLF = "\r\n";

	/**
	 * Newline character. (Use “\r\n” to comply with RFC 822)
	 *
	 * @var string
	 */
	public $newline = "\r\n";

	/**
	 * Enable BCC Batch Mode.
	 *
	 * @var boolean
	 */
	public $BCCBatchMode = false;

	/**
	 * Number of emails in each BCC batch
	 *
	 * @var integer
	 */
	public $BCCBatchSize = 200;

	/**
	 * Enable notify message from server
	 *
	 * @var boolean
	 */
	public $DSN = false;
}
