<?php
namespace Eglobe\OrderNotes\Plugin\Magento\Checkout;

/**
 * Class LayoutProcessorPlugin
 *
 * Plugin for Magento Checkout's LayoutProcessor, allowing customization of the checkout layout.
 */
class LayoutProcessorPlugin
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;

    /**
     * @var \Magento\Customer\Model\AddressFactory
     */
    protected $customerAddressFactory;

    /**
     * @var \Magento\Framework\Data\Form\FormKey
     */
    protected $formKey;

    /**
     * LayoutProcessorPlugin constructor.
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\CheckoutAgreements\Model\ResourceModel\Agreement\CollectionFactory $agreementCollectionFactory
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Magento\Customer\Model\AddressFactory $customerAddressFactory
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\CheckoutAgreements\Model\ResourceModel\Agreement\CollectionFactory $agreementCollectionFactory,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Customer\Model\AddressFactory $customerAddressFactory
    ) {
        $this->scopeConfig = $context->getScopeConfig();
        $this->checkoutSession = $checkoutSession;
        $this->customerAddressFactory = $customerAddressFactory;
    }

    /**
     * After process function.
     *
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array $jsLayout
    ) {
        $isEnabled = (bool) $this->scopeConfig->getValue(
            'eglobe/general/enable',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        $customText = $this->scopeConfig->getValue(
            'eglobe/general/custom_text',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        $customLabel = $this->scopeConfig->getValue(
            'eglobe/general/custom_label',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );

        $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
        ['payment']['children']['payments-list']['children']['before-place-order']['children']['comment'] = [
            'component' => 'Magento_Ui/js/form/element/textarea',
            'config' => [
                'customScope' => 'shippingAddress',
                'template' => 'ui/form/field',
                'options' => [],
                'id' => 'comment'
            ],
            'dataScope' => 'ordercomment.comment',
            'label' => $customLabel,
            'provider' => 'checkoutProvider',
            'visible' => $isEnabled,
            'sortOrder' => 250,
            'id' => 'comment'
        ];

        return $jsLayout;
    }
}
