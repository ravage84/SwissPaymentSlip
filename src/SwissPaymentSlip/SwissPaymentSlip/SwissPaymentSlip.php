<?php
/**
 * Swiss Payment Slip
 *
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @copyright 2012-2015 Some nice Swiss guys
 * @author Manuel Reinhard <manu@sprain.ch>
 * @author Peter Siska <pesche@gridonic.ch>
 * @author Marc Würth ravage@bluewin.ch
 * @link https://github.com/sprain/class.Einzahlungsschein.php
 */

namespace SwissPaymentSlip\SwissPaymentSlip;

/**
 * Swiss Payment Slip
 *
 * A general purpose class for swiss payment slips. Data is organized by its sister class SwissPaymentSlipData.
 *
 * @todo Include CHF boxed slip image (609, SwissPaymentSlip+)
 * @todo Include EUR framed slip image (701) --> back side!
 * @todo Include EUR boxed slip image (701) --> back side!
 * @todo Implement cash on delivery (Nachnahme)
 * @todo Include cash on delivery (Nachnahme) slip image
 * @todo Create constants for the attribute keys
 * @todo Create constants for left, right and center text alignment (L, R, C)
 * @todo Create central cell placement and formatting code (lines as array, attributes)...
 * @todo Implement fluent interface
 * @todo Consider sub classing the orange and red payment slip
 * @todo Rename to Slip
 */
class SwissPaymentSlip
{
    /**
     * The payment slip value object, which contains the payment slip data
     *
     * @var SwissPaymentSlipData The payment slip value object
     */
    protected $paymentSlipData = null;

    /**
     * Starting X position of the slip
     *
     * @var int|float Starting X position of the slip in mm
     */
    protected $slipPosX = 0;

    /**
     * Starting Y position of the slip
     *
     * @var int|float Starting Y position of the slip in mm
     */
    protected $slipPosY = 191;

    /**
     * The height of the slip
     *
     * @var int|float
     */
    protected $slipHeight = 106; // default height of an orange slip

    /**
     * The width of the slip
     *
     * @var int|float
     */
    protected $slipWidth = 210; // default width of an orange slip

    /**
     * Background of the slip
     *
     * Can be either 'transparent', a color or an image
     *
     * @var null|string
     */
    protected $slipBackground = null;

    /**
     * The default font family
     *
     * @var string
     */
    protected $defaultFontFamily = 'Helvetica';

    /**
     * The default font size
     *
     * @var string
     */
    protected $defaultFontSize = '10';

    /**
     * The default font color
     *
     * @var string
     */
    protected $defaultFontColor = '#000';

    /**
     * The default line height
     *
     * @var int
     */
    protected $defaultLineHeight = 4;

    /**
     * The default text alignment
     *
     * @var string
     */
    protected $defaultTextAlign = 'L';

    /**
     * Determines whether the bank details should be displayed
     *
     * @var bool True if yes, false if no
     */
    protected $displayBank = true;

    /**
     * Determines whether the recipient details should be displayed
     *
     * @var bool True if yes, false if no
     */
    protected $displayRecipient = true;

    /**
     * Determines whether the account should be displayed
     *
     * @var bool True if yes, false if no
     */
    protected $displayAccount = true;

    /**
     * Determines whether the amount should be displayed
     *
     * @var bool True if yes, false if no
     */
    protected $displayAmount = true;

    /**
     * Determines whether the reference number should be displayed
     *
     * @var bool True if yes, false if no
     */
    protected $displayReferenceNr = true;

    /**
     * Determines whether the payer details should be displayed
     *
     * @var bool True if yes, false if no
     */
    protected $displayPayer = true;

    /**
     * Determines whether the IBAN should be displayed
     *
     * @var bool True if yes, false if no
     */
    protected $displayIban = false;

    /**
     * Determines whether the payment reason should be displayed
     *
     * @var bool True if yes, false if no
     */
    protected $displayPaymentReason = false;

    /**
     * Determines whether the code line at the bottom should be displayed
     *
     * @var bool True if yes, false if no
     */
    protected $displayCodeLine = true;

    /**
     * Attributes of the left bank element
     *
     * @var array
     */
    protected $bankLeftAttr = array();

    /**
     * Attributes of the right bank element
     *
     * @var array
     */
    protected $bankRightAttr = array();

    /**
     * Attributes of the left recipient element
     *
     * @var array
     */
    protected $recipientLeftAttr = array();

    /**
     * Attributes of the right recipient element
     *
     * @var array
     */
    protected $recipientRightAttr = array();

    /**
     * Attributes of the left account element
     *
     * @var array
     */
    protected $accountLeftAttr = array();

    /**
     * Attributes of the right account element
     *
     * @var array
     */
    protected $accountRightAttr = array();

    /**
     * Attributes of the left francs amount element
     *
     * @var array
     */
    protected $amountFrancsLeftAttr = array();

    /**
     * Attributes of the right francs amount element
     *
     * @var array
     */
    protected $amountFrancsRightAttr = array();

    /**
     * Attributes of the left cents amount element
     *
     * @var array
     */
    protected $amountCentsLeftAttr = array();

    /**
     * Attributes of the right cents amount element
     *
     * @var array
     */
    protected $amountCentsRightAttr = array();

    /**
     * Attributes of the left reference number element
     *
     * @var array
     */
    protected $referenceNumberLeftAttr = array();

    /**
     * Attributes of the right reference number element
     *
     * @var array
     */
    protected $referenceNumberRightAttr = array();

    /**
     * Attributes of the left payer element
     *
     * @var array
     */
    protected $payerLeftAttr = array();

    /**
     * Attributes of the right payer element
     *
     * @var array
     */
    protected $payerRightAttr = array();

    /**
     * Attributes of the code line element
     *
     * @var array
     */
    protected $codeLineAttr = array();

    /**
     * Create a new payment slip
     *
     * @param SwissPaymentSlipData $paymentSlipData The payment slip data.
     * @param float|null $slipPosX The optional X position of the slip.
     * @param float|null $slipPosY The optional Y position of the slip.
     */
    public function __construct(SwissPaymentSlipData $paymentSlipData, $slipPosX = null, $slipPosY = null)
    {
        $this->paymentSlipData = $paymentSlipData;

        if (!is_null($slipPosX)) {
            $this->setSlipPosX($slipPosX);
        }
        if (!is_null($slipPosY)) {
            $this->setSlipPosY($slipPosY);
        }
        $this->setDefaults();
    }

    /**
     * Sets the default attributes of the elements according to the type
     *
     * @return void
     */
    protected function setDefaults()
    {
        if ($this->paymentSlipData->isOrangeSlip()) {
            $this->setBankLeftAttr(3, 8, 50, 4);
            $this->setBankRightAttr(66, 8, 50, 4);
            $this->setRecipientLeftAttr(3, 23, 50, 4);
            $this->setRecipientRightAttr(66, 23, 50, 4);
            $this->setAccountLeftAttr(27, 43, 30, 4);
            $this->setAccountRightAttr(90, 43, 30, 4);
            $this->setAmountFrancsLeftAttr(5, 50.5, 35, 4);
            $this->setAmountFrancsRightAttr(66, 50.5, 35, 4);
            $this->setAmountCentsLeftAttr(50, 50.5, 6, 4);
            $this->setAmountCentsRightAttr(111, 50.5, 6, 4);
            $this->setReferenceNumberLeftAttr(3, 60, 50, 4, null, null, 8);
            $this->setReferenceNumberRightAttr(125, 33.5, 80, 4);
            $this->setPayerLeftAttr(3, 65, 50, 4);
            $this->setPayerRightAttr(125, 48, 50, 4);
            $this->setCodeLineAttr(64, 85, 140, 4, null, 'OCRB10');

            $this->setSlipBackground(__DIR__.'/Resources/img/ezs_orange.gif');

        } elseif ($this->paymentSlipData->isRedSlip()) {
            $this->setBankLeftAttr(3, 8, 50, 4);
            $this->setBankRightAttr(66, 8, 50, 4);
            $this->setRecipientLeftAttr(3, 23, 50, 4);
            $this->setRecipientRightAttr(66, 23, 50, 4);
            $this->setAccountLeftAttr(27, 43, 30, 4);
            $this->setAccountRightAttr(90, 43, 30, 4);
            $this->setAmountFrancsLeftAttr(5, 50.5, 35, 4);
            $this->setAmountFrancsRightAttr(66, 50.5, 35, 4);
            $this->setAmountCentsLeftAttr(50, 50.5, 6, 4);
            $this->setAmountCentsRightAttr(111, 50.5, 6, 4);
            $this->setReferenceNumberLeftAttr(3, 60, 50, 4, null, null, 8);
            $this->setReferenceNumberRightAttr(125, 33.5, 80, 4);
            $this->setPayerLeftAttr(3, 65, 50, 4);
            $this->setPayerRightAttr(125, 48, 50, 4);
            $this->setCodeLineAttr(64, 85, 140, 4, null, 'OCRB10');

            $this->setSlipBackground(__DIR__.'/Resources/img/ezs_red.gif');
        }
    }

    /**
     * Get the slip data object of the slip
     *
     * @return SwissPaymentSlipData The data object of the slip.
     */
    public function getPaymentSlipData()
    {
        return $this->paymentSlipData;
    }

    /**
     * Set the starting X & Y position of the slip
     *
     * @param float $slipPosX The starting X position of the slip.
     * @param float $slipPosY The starting Y position of the slip
     * @return bool True if successful, else false.
     */
    public function setSlipPosition($slipPosX, $slipPosY)
    {
        if ($this->setSlipPosX($slipPosX) &&
        $this->setSlipPosY($slipPosY)) {
            return true;
        }
        return false;
    }

    /**
     * Set the starting X position of the slip
     *
     * @param float $slipPosX The starting X position of the slip.
     * @return bool True if successful, else false.
     */
    protected function setSlipPosX($slipPosX)
    {
        if (is_int($slipPosX) || is_float($slipPosX)) {
            $this->slipPosX = $slipPosX;
            return true;
        }
        return false;
    }

    /**
     * Set the starting Y position of the slip
     *
     * @param float $slipPosY The starting Y position of the slip.
     * @return bool True if successful, else false.
     */
    protected function setSlipPosY($slipPosY)
    {
        if (is_int($slipPosY) || is_float($slipPosY)) {
            $this->slipPosY = $slipPosY;
            return true;
        }
        return false;
    }

    /**
     * Set the height & width of the slip
     *
     * @param float $slipWidth The width of the slip
     * @param float $slipHeight The height of the slip
     * @return bool True if successful, else false.
     */
    public function setSlipSize($slipWidth, $slipHeight)
    {
        if ($this->setSlipHeight($slipHeight) &&
        $this->setSlipWidth($slipWidth)) {
            return true;
        }
        return false;
    }

    /**
     * Set the width of the slip
     *
     * @param float $slipWidth The width of the slip
     * @return bool True if successful, else false.
     */
    protected function setSlipWidth($slipWidth)
    {
        if (is_int($slipWidth) || is_float($slipWidth)) {
            $this->slipWidth = $slipWidth;
            return true;
        }
        return false;
    }

    /**
     * Set the height of the slip
     *
     * @param float $slipHeight The height of the slip
     * @return bool True if successful, else false.
     */
    protected function setSlipHeight($slipHeight)
    {
        if (is_int($slipHeight) || is_float($slipHeight)) {
            $this->slipHeight = $slipHeight;
            return true;
        }
        return false;
    }

    /**
     * Set the background of the slip
     *
     * Can be either 'transparent', a color or an image
     *
     * @param string $slipBackground The background of the slip.
     * @return bool Always true.
     *
     * @todo Implement sanity checks on parameter (filename or color)
     */
    public function setSlipBackground($slipBackground)
    {
        $this->slipBackground = $slipBackground;

        return true;
    }

    /**
     * Set the attributes for a given payment slip element
     *
     * @param array $element The element (attributes) to set.
     * @param float|null $posX The X position.
     * @param float|null $posY The Y Position.
     * @param float|null $width The width.
     * @param float|null $height The height.
     * @param string|null $background The background.
     * @param string|null $fontFamily The font family.
     * @param float|null $fontSize The font size.
     * @param string|null $fontColor The font color.
     * @param float|null $lineHeight The line height.
     * @param string|null $textAlign The text alignment.
     * @return bool Always true.
     */
    protected function setAttributes(
        &$element,
        $posX = null,
        $posY = null,
        $width = null,
        $height = null,
        $background = null,
        $fontFamily = null,
        $fontSize = null,
        $fontColor = null,
        $lineHeight = null,
        $textAlign = null
    ) {
        if ($posX) {
            $element['PosX'] = $posX;
        } elseif (!isset($element['PosX'])) {
            $element['PosX'] = 0;
        }
        if ($posY) {
            $element['PosY'] = $posY;
        } elseif (!isset($element['PosY'])) {
            $element['PosY'] = 0;
        }
        if ($width) {
            $element['Width'] = $width;
        } elseif (!isset($element['Width'])) {
            $element['Width'] = 0;
        }
        if ($height) {
            $element['Height'] = $height;
        } elseif (!isset($element['Height'])) {
            $element['Height'] = 0;
        }
        if ($background) {
            $element['Background'] = $background;
        } elseif (!isset($element['Background'])) {
            $element['Background'] = 'transparent';
        }
        if ($fontFamily) {
            $element['FontFamily'] = $fontFamily;
        } elseif (!isset($element['FontFamily'])) {
            $element['FontFamily'] = $this->defaultFontFamily;
        }
        if ($fontSize) {
            $element['FontSize'] = $fontSize;
        } elseif (!isset($element['FontSize'])) {
            $element['FontSize'] = $this->defaultFontSize;
        }
        if ($fontColor) {
            $element['FontColor'] = $fontColor;
        } elseif (!isset($element['FontColor'])) {
            $element['FontColor'] = $this->defaultFontColor;
        }
        if ($lineHeight) {
            $element['LineHeight'] = $lineHeight;
        } elseif (!isset($element['LineHeight'])) {
            $element['LineHeight'] = $this->defaultLineHeight;
        }
        if ($textAlign) {
            $element['TextAlign'] = $textAlign;
        } elseif (!isset($element['TextAlign'])) {
            $element['TextAlign'] = $this->defaultTextAlign;
        }
        return true;

    }

    /**
     * Set the left bank attributes
     *
     * @param float|null $posX The X position.
     * @param float|null $posY The Y Position.
     * @param float|null $width The width.
     * @param float|null $height The height.
     * @param string|null $background The background.
     * @param string|null $fontFamily The font family.
     * @param float|null $fontSize The font size.
     * @param string|null $fontColor The font color.
     * @param float|null $lineHeight The line height.
     * @param string|null $textAlign The text alignment.
     * @return bool Always true.
     */
    public function setBankLeftAttr(
        $posX = null,
        $posY = null,
        $width = null,
        $height = null,
        $background = null,
        $fontFamily = null,
        $fontSize = null,
        $fontColor = null,
        $lineHeight = null,
        $textAlign = null
    ) {
        return $this->setAttributes(
            $this->bankLeftAttr,
            $posX,
            $posY,
            $width,
            $height,
            $background,
            $fontFamily,
            $fontSize,
            $fontColor,
            $lineHeight,
            $textAlign
        );
    }

    /**
     * Set the right bank attributes
     *
     * @param float|null $posX The X position.
     * @param float|null $posY The Y Position.
     * @param float|null $width The width.
     * @param float|null $height The height.
     * @param string|null $background The background.
     * @param string|null $fontFamily The font family.
     * @param float|null $fontSize The font size.
     * @param string|null $fontColor The font color.
     * @param float|null $lineHeight The line height.
     * @param string|null $textAlign The text alignment.
     * @return bool Always true.
     */
    public function setBankRightAttr(
        $posX = null,
        $posY = null,
        $width = null,
        $height = null,
        $background = null,
        $fontFamily = null,
        $fontSize = null,
        $fontColor = null,
        $lineHeight = null,
        $textAlign = null
    ) {
        return $this->setAttributes(
            $this->bankRightAttr,
            $posX,
            $posY,
            $width,
            $height,
            $background,
            $fontFamily,
            $fontSize,
            $fontColor,
            $lineHeight,
            $textAlign
        );
    }

    /**
     * Set the left recipient attributes
     *
     * @param float|null $posX The X position.
     * @param float|null $posY The Y Position.
     * @param float|null $width The width.
     * @param float|null $height The height.
     * @param string|null $background The background.
     * @param string|null $fontFamily The font family.
     * @param float|null $fontSize The font size.
     * @param string|null $fontColor The font color.
     * @param float|null $lineHeight The line height.
     * @param string|null $textAlign The text alignment.
     * @return bool Always true.
     */
    public function setRecipientLeftAttr(
        $posX = null,
        $posY = null,
        $width = null,
        $height = null,
        $background = null,
        $fontFamily = null,
        $fontSize = null,
        $fontColor = null,
        $lineHeight = null,
        $textAlign = null
    ) {
        return $this->setAttributes(
            $this->recipientLeftAttr,
            $posX,
            $posY,
            $width,
            $height,
            $background,
            $fontFamily,
            $fontSize,
            $fontColor,
            $lineHeight,
            $textAlign
        );
    }

    /**
     * Set the right recipient attributes
     *
     * @param float|null $posX The X position.
     * @param float|null $posY The Y Position.
     * @param float|null $width The width.
     * @param float|null $height The height.
     * @param string|null $background The background.
     * @param string|null $fontFamily The font family.
     * @param float|null $fontSize The font size.
     * @param string|null $fontColor The font color.
     * @param float|null $lineHeight The line height.
     * @param string|null $textAlign The text alignment.
     * @return bool Always true.
     */
    public function setRecipientRightAttr(
        $posX = null,
        $posY = null,
        $width = null,
        $height = null,
        $background = null,
        $fontFamily = null,
        $fontSize = null,
        $fontColor = null,
        $lineHeight = null,
        $textAlign = null
    ) {
        return $this->setAttributes(
            $this->recipientRightAttr,
            $posX,
            $posY,
            $width,
            $height,
            $background,
            $fontFamily,
            $fontSize,
            $fontColor,
            $lineHeight,
            $textAlign
        );
    }

    /**
     * Set the left account attributes
     *
     * @param float|null $posX The X position.
     * @param float|null $posY The Y Position.
     * @param float|null $width The width.
     * @param float|null $height The height.
     * @param string|null $background The background.
     * @param string|null $fontFamily The font family.
     * @param float|null $fontSize The font size.
     * @param string|null $fontColor The font color.
     * @param float|null $lineHeight The line height.
     * @param string|null $textAlign The text alignment.
     * @return bool Always true.
     */
    public function setAccountLeftAttr(
        $posX = null,
        $posY = null,
        $width = null,
        $height = null,
        $background = null,
        $fontFamily = null,
        $fontSize = null,
        $fontColor = null,
        $lineHeight = null,
        $textAlign = null
    ) {
        return $this->setAttributes(
            $this->accountLeftAttr,
            $posX,
            $posY,
            $width,
            $height,
            $background,
            $fontFamily,
            $fontSize,
            $fontColor,
            $lineHeight,
            $textAlign
        );
    }

    /**
     * Set the right account attributes
     *
     * @param float|null $posX The X position.
     * @param float|null $posY The Y Position.
     * @param float|null $width The width.
     * @param float|null $height The height.
     * @param string|null $background The background.
     * @param string|null $fontFamily The font family.
     * @param float|null $fontSize The font size.
     * @param string|null $fontColor The font color.
     * @param float|null $lineHeight The line height.
     * @param string|null $textAlign The text alignment.
     * @return bool Always true.
     */
    public function setAccountRightAttr(
        $posX = null,
        $posY = null,
        $width = null,
        $height = null,
        $background = null,
        $fontFamily = null,
        $fontSize = null,
        $fontColor = null,
        $lineHeight = null,
        $textAlign = null
    ) {
        return $this->setAttributes(
            $this->accountRightAttr,
            $posX,
            $posY,
            $width,
            $height,
            $background,
            $fontFamily,
            $fontSize,
            $fontColor,
            $lineHeight,
            $textAlign
        );
    }

    /**
     * Set the left francs amount attributes
     *
     * @param float|null $posX The X position.
     * @param float|null $posY The Y Position.
     * @param float|null $width The width.
     * @param float|null $height The height.
     * @param string|null $background The background.
     * @param string|null $fontFamily The font family.
     * @param float|null $fontSize The font size.
     * @param string|null $fontColor The font color.
     * @param float|null $lineHeight The line height.
     * @param string|null $textAlign The text alignment.
     * @return bool Always true.
     */
    public function setAmountFrancsLeftAttr(
        $posX = null,
        $posY = null,
        $width = null,
        $height = null,
        $background = null,
        $fontFamily = null,
        $fontSize = null,
        $fontColor = null,
        $lineHeight = null,
        $textAlign = null
    ) {
        if (!$textAlign) {
            $textAlign = 'R';
        }

        return $this->setAttributes(
            $this->amountFrancsLeftAttr,
            $posX,
            $posY,
            $width,
            $height,
            $background,
            $fontFamily,
            $fontSize,
            $fontColor,
            $lineHeight,
            $textAlign
        );
    }

    /**
     * Set the right francs amount attributes
     *
     * @param float|null $posX The X position.
     * @param float|null $posY The Y Position.
     * @param float|null $width The width.
     * @param float|null $height The height.
     * @param string|null $background The background.
     * @param string|null $fontFamily The font family.
     * @param float|null $fontSize The font size.
     * @param string|null $fontColor The font color.
     * @param float|null $lineHeight The line height.
     * @param string|null $textAlign The text alignment.
     * @return bool Always true.
     */
    public function setAmountFrancsRightAttr(
        $posX = null,
        $posY = null,
        $width = null,
        $height = null,
        $background = null,
        $fontFamily = null,
        $fontSize = null,
        $fontColor = null,
        $lineHeight = null,
        $textAlign = null
    ) {
        if (!$textAlign) {
            $textAlign = 'R';
        }

        return $this->setAttributes(
            $this->amountFrancsRightAttr,
            $posX,
            $posY,
            $width,
            $height,
            $background,
            $fontFamily,
            $fontSize,
            $fontColor,
            $lineHeight,
            $textAlign
        );
    }

    /**
     * Set the left cents amount attributes
     *
     * @param float|null $posX The X position.
     * @param float|null $posY The Y Position.
     * @param float|null $width The width.
     * @param float|null $height The height.
     * @param string|null $background The background.
     * @param string|null $fontFamily The font family.
     * @param float|null $fontSize The font size.
     * @param string|null $fontColor The font color.
     * @param float|null $lineHeight The line height.
     * @param string|null $textAlign The text alignment.
     * @return bool Always true.
     */
    public function setAmountCentsLeftAttr(
        $posX = null,
        $posY = null,
        $width = null,
        $height = null,
        $background = null,
        $fontFamily = null,
        $fontSize = null,
        $fontColor = null,
        $lineHeight = null,
        $textAlign = null
    ) {
        return $this->setAttributes(
            $this->amountCentsLeftAttr,
            $posX,
            $posY,
            $width,
            $height,
            $background,
            $fontFamily,
            $fontSize,
            $fontColor,
            $lineHeight,
            $textAlign
        );
    }

    /**
     * Set the right cents amount attributes
     *
     * @param float|null $posX The X position.
     * @param float|null $posY The Y Position.
     * @param float|null $width The width.
     * @param float|null $height The height.
     * @param string|null $background The background.
     * @param string|null $fontFamily The font family.
     * @param float|null $fontSize The font size.
     * @param string|null $fontColor The font color.
     * @param float|null $lineHeight The line height.
     * @param string|null $textAlign The text alignment.
     * @return bool Always true.
     */
    public function setAmountCentsRightAttr(
        $posX = null,
        $posY = null,
        $width = null,
        $height = null,
        $background = null,
        $fontFamily = null,
        $fontSize = null,
        $fontColor = null,
        $lineHeight = null,
        $textAlign = null
    ) {
        return $this->setAttributes(
            $this->amountCentsRightAttr,
            $posX,
            $posY,
            $width,
            $height,
            $background,
            $fontFamily,
            $fontSize,
            $fontColor,
            $lineHeight,
            $textAlign
        );
    }

    /**
     * Set the left reference number attributes
     *
     * @param float|null $posX The X position.
     * @param float|null $posY The Y Position.
     * @param float|null $width The width.
     * @param float|null $height The height.
     * @param string|null $background The background.
     * @param string|null $fontFamily The font family.
     * @param float|null $fontSize The font size.
     * @param string|null $fontColor The font color.
     * @param float|null $lineHeight The line height.
     * @param string|null $textAlign The text alignment.
     * @return bool Always true.
     */
    public function setReferenceNumberLeftAttr(
        $posX = null,
        $posY = null,
        $width = null,
        $height = null,
        $background = null,
        $fontFamily = null,
        $fontSize = null,
        $fontColor = null,
        $lineHeight = null,
        $textAlign = null
    ) {
        return $this->setAttributes(
            $this->referenceNumberLeftAttr,
            $posX,
            $posY,
            $width,
            $height,
            $background,
            $fontFamily,
            $fontSize,
            $fontColor,
            $lineHeight,
            $textAlign
        );
    }

    /**
     * Set the right reference number attributes
     *
     * @param float|null $posX The X position.
     * @param float|null $posY The Y Position.
     * @param float|null $width The width.
     * @param float|null $height The height.
     * @param string|null $background The background.
     * @param string|null $fontFamily The font family.
     * @param float|null $fontSize The font size.
     * @param string|null $fontColor The font color.
     * @param float|null $lineHeight The line height.
     * @param string|null $textAlign The text alignment.
     * @return bool Always true.
     */
    public function setReferenceNumberRightAttr(
        $posX = null,
        $posY = null,
        $width = null,
        $height = null,
        $background = null,
        $fontFamily = null,
        $fontSize = null,
        $fontColor = null,
        $lineHeight = null,
        $textAlign = null
    ) {
        if (!$textAlign) {
            $textAlign = 'R';
        }

        return $this->setAttributes(
            $this->referenceNumberRightAttr,
            $posX,
            $posY,
            $width,
            $height,
            $background,
            $fontFamily,
            $fontSize,
            $fontColor,
            $lineHeight,
            $textAlign
        );
    }

    /**
     * Set the left payer attributes
     *
     * @param float|null $posX The X position.
     * @param float|null $posY The Y Position.
     * @param float|null $width The width.
     * @param float|null $height The height.
     * @param string|null $background The background.
     * @param string|null $fontFamily The font family.
     * @param float|null $fontSize The font size.
     * @param string|null $fontColor The font color.
     * @param float|null $lineHeight The line height.
     * @param string|null $textAlign The text alignment.
     * @return bool Always true.
     */
    public function setPayerLeftAttr(
        $posX = null,
        $posY = null,
        $width = null,
        $height = null,
        $background = null,
        $fontFamily = null,
        $fontSize = null,
        $fontColor = null,
        $lineHeight = null,
        $textAlign = null
    ) {
        return $this->setAttributes(
            $this->payerLeftAttr,
            $posX,
            $posY,
            $width,
            $height,
            $background,
            $fontFamily,
            $fontSize,
            $fontColor,
            $lineHeight,
            $textAlign
        );
    }

    /**
     * Set the right payer attributes
     *
     * @param float|null $posX The X position.
     * @param float|null $posY The Y Position.
     * @param float|null $width The width.
     * @param float|null $height The height.
     * @param string|null $background The background.
     * @param string|null $fontFamily The font family.
     * @param float|null $fontSize The font size.
     * @param string|null $fontColor The font color.
     * @param float|null $lineHeight The line height.
     * @param string|null $textAlign The text alignment.
     * @return bool Always true.
     */
    public function setPayerRightAttr(
        $posX = null,
        $posY = null,
        $width = null,
        $height = null,
        $background = null,
        $fontFamily = null,
        $fontSize = null,
        $fontColor = null,
        $lineHeight = null,
        $textAlign = null
    ) {
        return $this->setAttributes(
            $this->payerRightAttr,
            $posX,
            $posY,
            $width,
            $height,
            $background,
            $fontFamily,
            $fontSize,
            $fontColor,
            $lineHeight,
            $textAlign
        );
    }

    /**
     * Set the code line attributes
     *
     * @param float|null $posX The X position.
     * @param float|null $posY The Y Position.
     * @param float|null $width The width.
     * @param float|null $height The height.
     * @param string|null $background The background.
     * @param string|null $fontFamily The font family.
     * @param float|null $fontSize The font size.
     * @param string|null $fontColor The font color.
     * @param float|null $lineHeight The line height.
     * @param string|null $textAlign The text alignment.
     * @return bool Always true.
     */
    public function setCodeLineAttr(
        $posX = null,
        $posY = null,
        $width = null,
        $height = null,
        $background = null,
        $fontFamily = null,
        $fontSize = null,
        $fontColor = null,
        $lineHeight = null,
        $textAlign = null
    ) {
        if (!$textAlign) {
            $textAlign = 'R';
        }

        return $this->setAttributes(
            $this->codeLineAttr,
            $posX,
            $posY,
            $width,
            $height,
            $background,
            $fontFamily,
            $fontSize,
            $fontColor,
            $lineHeight,
            $textAlign
        );
    }

    /**
     * Get the attributes of the left account element
     *
     * @return array The attributes of the left account element.
     */
    public function getAccountLeftAttr()
    {
        return $this->accountLeftAttr;
    }

    /**
     * Get the attributes of the right account element
     *
     * @return array The attributes of the right account element.
     */
    public function getAccountRightAttr()
    {
        return $this->accountRightAttr;
    }

    /**
     * Get the attributes of the right cents amount element
     *
     * @return array The attributes of the right cents amount element.
     */
    public function getAmountCentsRightAttr()
    {
        return $this->amountCentsRightAttr;
    }

    /**
     * Get the attributes of the left cents amount element
     *
     * @return array The attributes of the left cents amount element.
     */
    public function getAmountCentsLeftAttr()
    {
        return $this->amountCentsLeftAttr;
    }

    /**
     * Get the attributes of the left francs amount element
     *
     * @return array The attributes of the left francs amount element.
     */
    public function getAmountFrancsLeftAttr()
    {
        return $this->amountFrancsLeftAttr;
    }

    /**
     * Get the attributes of the right francs amount element
     *
     * @return array The attributes of the right francs amount element.
     */
    public function getAmountFrancsRightAttr()
    {
        return $this->amountFrancsRightAttr;
    }

    /**
     * Get the attributes of the left bank element
     *
     * @return array The attributes of the left bank element.
     */
    public function getBankLeftAttr()
    {
        return $this->bankLeftAttr;
    }

    /**
     * Get the attributes of the right bank element
     *
     * @return array The attributes of the right bank element.
     */
    public function getBankRightAttr()
    {
        return $this->bankRightAttr;
    }

    /**
     * Get the attributes of the code line element
     *
     * @return array The attributes of the code line element.
     */
    public function getCodeLineAttr()
    {
        return $this->codeLineAttr;
    }

    /**
     * Get the attributes of the right recipient element
     *
     * @return array The attributes of the right recipient element.
     */
    public function getRecipientRightAttr()
    {
        return $this->recipientRightAttr;
    }

    /**
     * Get the attributes of the left recipient element
     *
     * @return array The attributes of the left recipient element.
     */
    public function getRecipientLeftAttr()
    {
        return $this->recipientLeftAttr;
    }

    /**
     * Get the attributes of the right payer element
     *
     * @return array The attributes of the right payer element.
     */
    public function getPayerRightAttr()
    {
        return $this->payerRightAttr;
    }

    /**
     * Get the attributes of the left payer element
     *
     * @return array The attributes of the left payer element.
     */
    public function getPayerLeftAttr()
    {
        return $this->payerLeftAttr;
    }

    /**
     * Get the attributes of the left reference number element
     *
     * @return array The attributes of the left reference number element.
     */
    public function getReferenceNumberLeftAttr()
    {
        return $this->referenceNumberLeftAttr;
    }

    /**
     * Get the attributes of the right reference umber element
     *
     * @return array The attributes of the right reference umber element.
     */
    public function getReferenceNumberRightAttr()
    {
        return $this->referenceNumberRightAttr;
    }

    /**
     * Get the background of the slip
     *
     * Can be either 'transparent', a color or an image
     *
     * @return null|string The slip background.
     */
    public function getSlipBackground()
    {
        return $this->slipBackground;
    }

    /**
     * Get the starting X position of the slip
     *
     * @return int|float The starting X position of the slip.
     */
    public function getSlipPosX()
    {
        return $this->slipPosX;
    }

    /**
     * Get the starting Y position of the slip
     *
     * @return int|float The starting Y position of the slip.
     */
    public function getSlipPosY()
    {
        return $this->slipPosY;
    }

    /**
     * Get the width of the slip
     *
     * @return int|float The width of the slip.
     */
    public function getSlipWidth()
    {
        return $this->slipWidth;
    }

    /**
     * Get the height of the slip
     *
     * @return int|float The height of the slip.
     */
    public function getSlipHeight()
    {
        return $this->slipHeight;
    }

    /**
     * Set whether or not to display the account
     *
     * @param bool $displayAccount True if yes, false if no.
     * @return bool True if successful, else false..
     */
    public function setDisplayAccount($displayAccount = true)
    {
        if (is_bool($displayAccount)) {
            $this->displayAccount = $displayAccount;
            return true;
        }
        return false;
    }

    /**
     * Get whether or not to display the account
     *
     * @return bool True if yes, false if no.
     */
    public function getDisplayAccount()
    {
        return $this->displayAccount;
    }

    /**
     * Set whether or not to display the amount
     *
     * @param bool $displayAmount True if yes, false if no
     * @return bool True if successful, else false.
     */
    public function setDisplayAmount($displayAmount = true)
    {
        if (is_bool($displayAmount)) {
            $this->displayAmount = $displayAmount;
            return true;
        }
        return false;
    }

    /**
     * Get whether or not to display the amount
     *
     * @return bool True if yes, false if no.
     */
    public function getDisplayAmount()
    {
        return $this->displayAmount;
    }

    /**
     * Set whether or not to display the bank
     *
     * @param bool $displayBank True if yes, false if no
     * @return bool True if successful, else false.
     */
    public function setDisplayBank($displayBank = true)
    {
        if (is_bool($displayBank)) {
            $this->displayBank = $displayBank;
            return true;
        }
        return false;
    }

    /**
     * Get whether or not to display the bank
     *
     * @return bool True if yes, false if no.
     */
    public function getDisplayBank()
    {
        return $this->displayBank;
    }

    /**
     * Set whether or not to display the payer
     *
     * @param bool $displayPayer True if yes, false if no
     * @return bool True if successful, else false.
     */
    public function setDisplayPayer($displayPayer = true)
    {
        if (is_bool($displayPayer)) {
            $this->displayPayer = $displayPayer;
            return true;
        }
        return false;
    }

    /**
     * Get whether or not to display the payer
     *
     * @return bool True if yes, false if no.
     */
    public function getDisplayPayer()
    {
        return $this->displayPayer;
    }

    /**
     * Set whether or not to display the recipient
     *
     * @param bool $displayRecipient True if yes, false if no
     * @return bool True if successful, else false.
     */
    public function setDisplayRecipient($displayRecipient = true)
    {
        if (is_bool($displayRecipient)) {
            $this->displayRecipient = $displayRecipient;
            return true;
        }
        return false;
    }

    /**
     * Get whether or not to display the recipient
     *
     * @return bool True if yes, false if no.
     */
    public function getDisplayRecipient()
    {
        return $this->displayRecipient;
    }

    /**
     * Set whether or not to display the reference number
     *
     * @param bool $displayReferenceNr True if yes, false if no
     * @return bool True if successful, else false.
     */
    public function setDisplayReferenceNr($displayReferenceNr = true)
    {
        if (is_bool($displayReferenceNr)) {
            $this->displayReferenceNr = $displayReferenceNr;
            return true;
        }
        return false;
    }

    /**
     * Get whether or not to display the reference number
     *
     * @return bool True if yes, false if no.
     */
    public function getDisplayReferenceNr()
    {
        return $this->displayReferenceNr;
    }

    /**
     * Set whether or not to display the IBAN
     *
     * @param bool $displayIban True if yes, false if no
     * @return bool True if successful, else false.
     */
    public function setDisplayIban($displayIban = true)
    {
        if (is_bool($displayIban)) {
            $this->displayIban = $displayIban;
            return true;
        }
        return false;
    }

    /**
     * Get whether or not to display the IBAN
     *
     * @return bool True if yes, false if no.
     */
    public function getDisplayIban()
    {
        return $this->displayIban;
    }

    /**
     * Set whether or not to display the payment reason lines
     *
     * @param bool $displayPaymentReason True if yes, false if no
     * @return bool True if successful, else false.
     */
    public function setDisplayPaymentReason($displayPaymentReason = true)
    {
        if (is_bool($displayPaymentReason)) {
            $this->displayPaymentReason = $displayPaymentReason;
            return true;
        }
        return false;
    }

    /**
     * Get whether or not to display the payment reason lines
     *
     * @return bool True if yes, false if no.
     */
    public function getDisplayPaymentReason()
    {
        return $this->displayPaymentReason;
    }

    /**
     * Set whether or not to display the code line at the bottom
     *
     * @param bool $displayCodeLine True if yes, false if no
     * @return bool True if successful, else false.
     */
    public function setDisplayCodeLine($displayCodeLine = true)
    {
        if (is_bool($displayCodeLine)) {
            $this->displayCodeLine = $displayCodeLine;
            return true;
        }
        return false;
    }

    /**
     * Get whether or not to display the code line at the bottom
     *
     * @return bool True if yes, false if no.
     */
    public function getDisplayCodeLine()
    {
        return $this->displayCodeLine;
    }

    /**
     * Get all elements of the slip
     *
     * @param bool $formatted Whether to return the reference number formatted or not.
     * @param bool $fillZeroes Whether to return the reference number filled with zeros or not.
     * @return array All elements with their lines and attributes.
     */
    public function getAllElements($formatted = true, $fillZeroes = true)
    {
        $paymentSlipData = $this->paymentSlipData;

        $elements = array();
        // Place left bank lines
        if ($this->getDisplayBank()) {
            $lines = array($paymentSlipData->getBankName(),
            $paymentSlipData->getBankCity());
            $elements['bankLeft'] = array('lines' => $lines,
            'attributes' => $this->getBankLeftAttr()
            );
        }

        // Place right bank lines
        if ($this->getDisplayBank()) {
               // Reuse lines from above
            $elements['bankRight'] = array('lines' => $lines,
            'attributes' => $this->getBankRightAttr()
            );
        }

        // Place left recipient lines
        if ($this->getDisplayRecipient()) {
            $lines = array($paymentSlipData->getRecipientLine1(),
            $paymentSlipData->getRecipientLine2(), $paymentSlipData->getRecipientLine3(),
            $paymentSlipData->getRecipientLine4());
            $elements['recipientLeft'] = array('lines' => $lines,
            'attributes' => $this->getRecipientLeftAttr()
            );
        }

        // Place right recipient lines
        if ($this->getDisplayRecipient()) {
            // Reuse lines from above
            $elements['recipientRight'] = array('lines' => $lines,
            'attributes' => $this->getRecipientRightAttr()
            );
        }

        // Place left account number
        if ($this->getDisplayAccount()) {
            $lines = array($paymentSlipData->getAccountNumber());
            $elements['accountLeft'] = array('lines' => $lines,
            'attributes' => $this->getAccountLeftAttr()
            );
        }

        // Place right account number
        if ($this->getDisplayAccount()) {
            // Reuse lines from above
            $elements['accountRight'] = array('lines' => $lines,
            'attributes' => $this->getAccountRightAttr()
            );
        }

        // Place left amount in francs
        if ($this->getDisplayAmount()) {
            $lines = array($this->paymentSlipData->getAmountFrancs());
            $elements['amountFrancsLeft'] = array('lines' => $lines,
            'attributes' => $this->getAmountFrancsLeftAttr()
            );
        }

        // Place right amount in francs
        if ($this->getDisplayAmount()) {
            // Reuse lines from above
            $elements['amountFrancsRight'] = array('lines' => $lines,
            'attributes' => $this->getAmountFrancsRightAttr()
            );
        }

        // Place left amount in cents
        if ($this->getDisplayAmount()) {
            $lines = array($this->paymentSlipData->getAmountCents());
            $elements['amountCentsLeft'] = array('lines' => $lines,
            'attributes' => $this->getAmountCentsLeftAttr()
            );
        }

        // Place right amount in cents
        if ($this->getDisplayAmount()) {
            // Reuse lines from above
            $elements['amountCentsRight'] = array('lines' => $lines,
            'attributes' => $this->getAmountCentsRightAttr()
            );
        }

        // Place left reference number
        if ($this->getDisplayReferenceNr()) {
            $lines = array($this->paymentSlipData->getCompleteReferenceNumber($formatted, $fillZeroes));
            $elements['referenceNumberLeft'] = array('lines' => $lines,
            'attributes' => $this->getReferenceNumberLeftAttr()
            );
        }

        // Place right reference number
        if ($this->getDisplayReferenceNr()) {
            // Reuse lines from above
            $elements['referenceNumberRight'] = array('lines' => $lines,
            'attributes' => $this->getReferenceNumberRightAttr()
            );
        }

       // Place left payer lines
        if ($this->getDisplayPayer()) {
            $lines = array($paymentSlipData->getPayerLine1(),
            $paymentSlipData->getPayerLine2(), $paymentSlipData->getPayerLine3(),
            $paymentSlipData->getPayerLine4());
            $elements['payerLeft'] = array('lines' => $lines,
            'attributes' => $this->getPayerLeftAttr()
            );
        }

       // Place right payer lines
        if ($this->getDisplayPayer()) {
            // Reuse lines from above
            $elements['payerRight'] = array('lines' => $lines,
            'attributes' => $this->getPayerRightAttr()
            );
        }

        // Place code line
        if ($this->getDisplayCodeLine()) {
            $lines = array($this->paymentSlipData->getCodeLine($fillZeroes));
            $elements['codeLine'] = array('lines' => $lines,
            'attributes' => $this->getCodeLineAttr()
            );
        }

        return $elements;
    }
}
