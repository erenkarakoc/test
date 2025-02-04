window.getAssetPrice = async symbol => {
  try {
    const response = await fetch(`https://api.binance.com/api/v3/ticker/price?symbol=${symbol.toUpperCase()}USDT`);

    if (response.ok) {
      const data = await response.json();
      return parseFloat(data.price).toFixed(2); // Return the price as a string formatted to 2 decimal places
    } else {
      console.error('Error fetching asset price:', response.statusText);
      return null;
    }
  } catch (error) {
    console.error('Error fetching asset price:', error);
    return null;
  }
};

window.convertAsset = async (fromAsset, toAsset, amount) => {
  const fromAssetUsdPrice = await getAssetPrice(fromAsset);
  const toAssetUsdPrice = toAsset === 'USDT' ? 1 : await getAssetPrice(toAsset);

  if (fromAssetUsdPrice !== null && toAssetUsdPrice !== null) {
    const usdAmount = amount * parseFloat(fromAssetUsdPrice);
    return (usdAmount / parseFloat(toAssetUsdPrice)).toFixed(2);
  }

  return null;
};

window.getAssetChartData = async symbol => {
  const endTime = Date.now(); // Current time in milliseconds
  const startTime = endTime - 7 * 24 * 60 * 60 * 1000; // 7 days ago

  const url = `https://api.binance.com/api/v3/klines?symbol=${symbol.toUpperCase()}USDT&interval=1d&startTime=${startTime}&endTime=${endTime}&limit=168`;

  try {
    const response = await fetch(url);

    if (response.ok) {
      const data = await response.json();
      return data.map(item => ({
        time: item[0], // Open time
        close: parseFloat(item[4]) // Closing price
      }));
    } else {
      console.error('Error fetching chart data:', response.statusText);
      return null;
    }
  } catch (error) {
    console.error('Error fetching chart data:', error);
    return null;
  }
};

window.convertUsdToEur = async usdAmount => {
  try {
    const response = await fetch('https://api.exchangerate-api.com/v4/latest/USD');

    if (response.ok) {
      const data = await response.json();
      const eurRate = data.rates['EUR'];

      if (eurRate) {
        return (usdAmount * eurRate).toFixed(2);
      }
    }

    return null;
  } catch (error) {
    console.error('Error fetching USD to EUR conversion rate:', error);
    return null;
  }
};

window.formatBalance = balance => {
  // Check if the balance is zero
  if (parseFloat(balance).toFixed(8) === '0.00000000') {
    return '0.00';
  }

  // Format the balance with 8 decimal places
  let formattedBalance = parseFloat(balance).toFixed(8);

  // Remove trailing zeros after decimal point but keep at least two decimal places
  formattedBalance = formattedBalance.replace(/\.?0+$/, '');

  // If no decimal part, add '.00'
  if (!formattedBalance.includes('.')) {
    formattedBalance += '.00';
  } else {
    // Ensure at least two decimal places
    let parts = formattedBalance.split('.');
    let decimals = parts[1].length;
    if (decimals < 2) {
      parts[1] = parts[1].padEnd(2, '0');
      formattedBalance = parts.join('.');
    }
  }

  return formattedBalance;
};
