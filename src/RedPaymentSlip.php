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
 * Red Swiss Payment Slip
 *
 * A general purpose class for red swiss payment slips.
 * Data is organized by its sister class RedPaymentSlipData.
 *
 * @uses RedPaymentSlipData To store the slip data.
 */
class RedPaymentSlip extends PaymentSlip
{
    /**
     * The payment slip value object, which contains the payment slip data
     *
     * @var RedPaymentSlipData The orange payment slip value object
     */
    protected $paymentSlipData = null;

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
     * Determines whether the IBAN should be displayed
     *
     * @var bool True if yes, false if no
     */
    protected $displayIban = true;

    /**
     * Determines whether the payment reason should be displayed
     *
     * @var bool True if yes, false if no
     */
    protected $displayPaymentReason = true;

    /**
     * Attributes of the left IBAN element
     *
     * @var array
     */
    protected $ibanLeftAttr = array();

    /**
     * Attributes of the rightIBAN element
     *
     * @var array
     */
    protected $ibanRightAttr = array();

    /**
     * Attributes of the payment reason element
     *
     * @var array
     */
    protected $paymentReasonAttr = array();

    /**
     * Create a new red payment slip
     *
     * @param RedPaymentSlipData $paymentSlipData The red payment slip data.
     * @param float|null $slipPosX The optional X position of the slip.
     * @param float|null $slipPosY The optional Y position of the slip.
     */
    public function __construct(RedPaymentSlipData $paymentSlipData, $slipPosX = null, $slipPosY = null)
    {
        parent::__construct($paymentSlipData, $slipPosX, $slipPosY);
    }

    /**
     * Sets the default attributes of the elements for a red slip
     *
     * @return $this The current instance for a fluent interface.
     * @todo Set default attributes for $ibanLeftAttr, $ibanRightAttr & $paymentReasonAttr
     */
    protected function setDefaults()
    {
        parent::setDefaults();

        $this->setIbanLeftAttr();
        $this->setIbanRightAttr();
        $this->setPaymentReasonAttr();

        $this->setSlipBackground(__DIR__.'/Resources/img/ezs_red.gif');

        return $this;
    }

    /**
     * Set the left IBAN attributes
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
     * @return $this The current instance for a fluent interface.
     */
    public function setIbanLeftAttr(
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
        $this->setAttributes(
            $this->ibanLeftAttr,
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

        return $this;
    }

    /**
     * Set the right IBAN attributes
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
     * @return $this The current instance for a fluent interface.
     */
    public function setIbanRightAttr(
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
        $this->setAttributes(
            $this->ibanRightAttr,
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

        return $this;
    }

    /**
     * Get the attributes of the left IBAN element
     *
     * @return array The attributes of the left IBAN element.
     */
    public function getIbanLeftAttr()
    {
        return $this->ibanLeftAttr;
    }

    /**
     * Get the attributes of the right IBAN element
     *
     * @return array The attributes of the right IBAN element.
     */
    public function getIbanRightAttr()
    {
        return $this->ibanRightAttr;
    }

    /**
     * Set the payment reason attributes
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
     * @return $this The current instance for a fluent interface.
     */
    public function setPaymentReasonAttr(
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
        $this->setAttributes(
            $this->paymentReasonAttr,
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

        return $this;
    }

    /**
     * Get the attributes of the payment reason element
     *
     * @return array The attributes of the payment reason element.
     */
    public function getPaymentReasonAttr()
    {
        return $this->paymentReasonAttr;
    }

    /**
     * Set whether or not to display the IBAN
     *
     * @param bool $displayIban True if yes, false if no
     * @return $this The current instance for a fluent interface.
     */
    public function setDisplayIban($displayIban = true)
    {
        if (is_bool($displayIban)) {
            $this->displayIban = $displayIban;
        }

        return $this;
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
     * @return $this The current instance for a fluent interface.
     */
    public function setDisplayPaymentReason($displayPaymentReason = true)
    {
        if (is_bool($displayPaymentReason)) {
            $this->displayPaymentReason = $displayPaymentReason;
        }

        return $this;
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
     * Get all elements of the slip
     *
     * @param bool $formatted Whether to return the reference number formatted or not.
     * @param bool $fillZeroes No functionality for red payment slips.
     * @return array All elements with their lines and attributes.
     */
    public function getAllElements($formatted = true, $fillZeroes = true)
    {
        $paymentSlipData = $this->paymentSlipData;

        $elements = parent::getAllElements($formatted, $fillZeroes);

        if ($this->getDisplayPaymentReason()) {
            // Place payment reason lines
            $lines = array(
                $paymentSlipData->getPaymentReasonLine1(),
                $paymentSlipData->getPaymentReasonLine2(),
                $paymentSlipData->getPaymentReasonLine3(),
                $paymentSlipData->getPaymentReasonLine4()
            );
            $elements['paymentReason'] = array(
                'lines' => $lines,
                'attributes' => $this->getPaymentReasonAttr()
            );
        }

        return $elements;
    }
}
